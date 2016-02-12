package controllers

import (
	"artfill/models"
	"bytes"
	"crypto/md5"
	"crypto/rand"
	"encoding/base64"
	"fmt"
	"github.com/astaxie/beego/config"
	"github.com/astaxie/beego/orm"
	"github.com/astaxie/beego/session"

	// "github.com/astaxie/beego/logs"
	// "github.com/apexskier/httpauth"
	"github.com/astaxie/beego"
)

var globalSessions *session.Manager

type MainController struct {
	beego.Controller
}

func init() {
	globalSessions, _ = session.NewManager("mysql", "gosessionid", 3600, db_username+":"+db_password+"@/"+db_dbname+"?charset=utf8", false, "sha1", "sessionid", 3600)
	go globalSessions.GC()
}

func (c *MainController) Index() {
	c.TplName = "site/try_bootstrap.html"
	// c.TplNames = "site/try_bootstrap.html"

	// c.SetSession("user", "")
	// c.Ctx.SetCookie("cookie_user", "artfill cookie", 60*2, "/")
}

func (c *MainController) All404() {
	c.TplName = "404.html"
}

func (c *MainController) Login() {
	method := c.Ctx.Request.Method
	if method == "GET" {
		c.TplName = "site/login.html"
		c.Layout = "basic-layout.tpl"

	} else {
		o := orm.NewOrm()
		o.Using("default")

		u := models.User{}
		if err := c.ParseForm(&u); err != nil {
			//handle error

		} else {
			// c.Ctx.WriteString(u.Name)
		}
		md5Password := md5.New()
		// io.WriteString(md5Password, u.Password)
		buffer := bytes.NewBuffer(nil)
		fmt.Fprintf(buffer, "%x", md5Password.Sum(nil))
		newPass := buffer.String()
		fmt.Println(newPass)
		// c.Ctx.WriteString(newPass)

		validated := true
		if validated {

			// c.Ctx.WriteString("\nLogin successful")
			sess := globalSessions.StartSession()
			c.SessionRegenerateID()
			sess.Set("sessionid", u.Id)
			c.Ctx.Redirect(302, "http://www.google.com")
			// sess := session.
		}
	}
}

func GenerateRandomBytes(n int) ([]byte, error) {
	b := make([]byte, n)
	_, err := rand.Read(b)
	if err != nil {
		return nil, err
	}

	return b, nil
}

func GenerateRandomString(s int) (string, error) {
	b, err := GenerateRandomBytes(s)
	return base64.URLEncoding.EncodeToString(b), err
}

// func (c *MainController) Register() {
// 	c.Data["Form"] = &(models.User{})
// }
