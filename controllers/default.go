package controllers

import (
	"artfill_lab/models"
	pk "artfill_lab/utilities/pbkdf2"
	"encoding/hex"
	"fmt"
	"github.com/twinj/uuid"
	"gopkg.in/gomail.v2"
	"strings"
	"time"

	"github.com/astaxie/beego/orm"
	"github.com/astaxie/beego/validation"

	// "github.com/apexskier/httpauth"
	"github.com/astaxie/beego"
)

// MainController
type MainController struct {
	beego.Controller
}

func init() {
}

func (c *MainController) Index() {
	// c.Layout = "basic-layout.tpl"
	// c.LayoutSections = make(map[string]string)
	// c.LayoutSections["Header"] = "site/header.html"
	// c.LayoutSections["LayoutContent"] = "site/try_bootstrap.html"

	c.TplName = "site/try_bootstrap.html"
}

func (c *MainController) All404() {
	c.TplName = "404.html"
}

func (c *MainController) Login() {
	c.TplName = "site/login.html"
	sess := c.GetSession("artfill")
	if sess != nil {
		c.Data["InSession"] = 1 // for login bar in header.tpl
		m := sess.(map[string]interface{})
		c.Data["username"] = m["username"]
	}
	back := strings.Replace(c.Ctx.Input.Param(":back"), ">", "/", -1) // allow for deeper URL such as l1/l2/l3 represented by l1>l2>l3
	beego.Debug("back is ", back)
	if c.Ctx.Request.Method == "GET" {
		c.TplName = "site/login.html"
		c.Layout = "basic-layout.tpl"
		// c.LayoutSections["Header"] = "site/header.html"

	} else {
		flash := beego.NewFlash()
		username := c.GetString("username")
		password := c.GetString("password")

		valid := validation.Validation{}
		valid.Required(username, "username")
		valid.Required(password, "password")
		if valid.HasErrors() {
			errmap := []string{}
			for _, err := range valid.Errors {
				errmap = append(errmap, "Validaiton failed on "+err.Key+": "+err.Message+"\n")
			}
			c.Data["Errors"] = errmap
			return
		}
		beego.Debug("Login attempt \t", username, ":", password)

		var pH pk.PasswordHash
		pH.Hash = make([]byte, 32)
		pH.Salt = make([]byte, 16)

		user := models.User{Name: username}

		o := orm.NewOrm()
		o.Using("default")

		err := o.Read(&user, "Name")
		if err == nil {
			if !user.IsVerified {
				flash.Error("Account not verified")
				flash.Store(&c.Controller)
				return
			}

			beego.Debug("password to scan: ", user.Password)
			if pH.Hash, err = hex.DecodeString(user.Password[:64]); err != nil {
				fmt.Println("ERROR:", err)
			}
			if pH.Salt, err = hex.DecodeString(user.Password[64:]); err != nil {
				fmt.Println("ERROR:", err)
			}
			beego.Debug("decoded password is", pH)
		} else {
			flash.Error("No such user/email")
			flash.Store(&c.Controller)
		}

		if !pk.MatchPassword(password, &pH) {
			flash.Error("bad password")
			flash.Store(&c.Controller)
			return
		}

		m := make(map[string]interface{})
		m["username"] = username
		m["timestamp"] = time.Now()
		c.SetSession("artfill", m)
		c.Redirect("/"+back, 302)
	}
}

func (c *MainController) Logout() {
	c.TplName = "site/login.html"
	c.DelSession("artfill")
	c.Redirect("/", 302)
}

func (c *MainController) Register() {
	c.TplName = "site/register.html"
	if c.Ctx.Input.Method() == "POST" {
		flash := beego.NewFlash()
		user := models.User{}
		if err := c.ParseForm(user); err != nil {
			flash.Error("cannot parse user form")
			flash.Store(&c.Controller)
			return
		}
		password2 := c.GetString("password2")
		valid := validation.Validation{}
		valid.Required(user.Name, "username")
		valid.Email(user.Email, "email")
		valid.MinSize(user.Password, 6, "password")
		valid.Required(password2, "password2")
		if valid.HasErrors() {
			errormap := []string{}
			for _, err := range valid.Errors {
				errormap = append(errormap, "Validation failed on "+err.Key+": "+err.Message+"\n")
			}
			c.Data["Errors"] = errormap
			return
		}
		if user.Password != password2 {
			flash.Error("Passwords don't match")
			flash.Store(&c.Controller)
			return
		}

		h := pk.HashPassword(user.Password)
		o := orm.NewOrm()
		o.Using("default")
		user.Password = hex.EncodeToString(h.Hash) + hex.EncodeToString(h.Salt)

		u := uuid.NewV4()
		user.VerKey = u.String()
		_, err := o.Insert(&user)
		if err != nil {
			flash.Error(user.Email + "already registered")
			flash.Store(&c.Controller)
			return
		}

		if !sendVerification(user.Email, u.String()) {
			flash.Error("Unable to send verification email")
			flash.Store(&c.Controller)
			return
		}
		flash.Notice("your account has been created. Verify your account")
		flash.Store(&c.Controller)
		c.Redirect("/index", 302)
	} else {
		c.Data["form"] = beego.RenderForm(&models.User{})
	}
}

func sendVerification(email, u string) bool {
	link := "http://localhost:8080/user/verify/" + u
	host := "smtp.gmail.com"
	port := 587

	m := gomail.NewMessage()
	m.SetHeader("From", "digit4free@gmail.com")
	m.SetHeader("To", email)
	m.SetHeader("Subject", "Hello!")
	m.SetBody("text/html", "To verify your account, please click on the link: <a href=\""+link+
		"\">"+link+"</a><br><br>Best Regards,<br>ACME Corporation")
	// m.Attach("/home/Alex/lolcat.jpg")

	d := gomail.NewPlainDialer(host, port, "digit4free@gmail.com", "mobuftxylpqulbhi")

	// Send the email to Bob, Cora and Dan.
	if err := d.DialAndSend(m); err != nil {
		return false
	}
	return true
}

func (c *MainController) Verify() {
	c.TplName = "site/Verify"

	u := c.Ctx.Input.Param(":uuid")
	o := orm.NewOrm()
	o.Using("default")

	user := models.User{VerKey: u}
	err := o.Read(&user, "VerKey")
	if err == nil {
		c.Data["IsVerified"] = 1
		user.VerKey = ""
		if _, err := o.Update(&user); err != nil {
			delete(c.Data, "IsVerified")
		}
	}
}
