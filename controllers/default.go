package controllers

import (
	"artfill/config"
	"artfill/models"
	"bytes"
	"crypto/md5"
	"github.com/astaxie/beego/logs"
	// "net/http"
	// "crypto/rand"
	// "encoding/base64"
	"fmt"
	"github.com/astaxie/beego/orm"

	// "github.com/astaxie/beego/logs"
	// "github.com/apexskier/httpauth"
	"github.com/astaxie/beego"
)

type MainController struct {
	beego.Controller
}

func init() {
	log := logs.NewLogger(100000)
	log.SetLogger("console", "")
	config.SetupConstants()
	// conn := config.Constants.DbUsername + ":" + config.Constants.DbPassword + "@/" + config.Constants.DbDatabase + "?charset=utf8"
	// globalSessions, _ = session.NewManager(
	// "mysql", `{"cookieName":"gosessionid","gclifetime":3600,"ProviderConfig":"root:toor@3306(127.0.0.1)/artfill?charset=utf8"}`)
	// go globalSessions.GC()

	// globalSessions, _ = session.NewManager("mysql", "artfillsession", 3600, config.MySQLConn, false, "sha1", "sessionid", 3600)
	// go globalSessions.GC()
}

func (c *MainController) Index() {
	c.Layout = "basic-layout.tpl"
	c.LayoutSections = make(map[string]string)
	c.LayoutSections["Header"] = "site/header.html"
	c.LayoutSections["LayoutContent"] = "site/try_bootstrap.html"

	c.TplName = "site/try_bootstrap.html"

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
			c.Ctx.WriteString("\nLogin successful")
			c.SetSession("name", int(1))
			// defer sess.SessionRelease(c.Ctx.ResponseWriter)
			// c.SessionRegenerateID()
			c.Ctx.Redirect(302, "http://www.google.com")
			// sess := session.
		}
	}
}

// func GenerateRandomBytes(n int) ([]byte, error) {
// 	b := make([]byte, n)
// 	_, err := rand.Read(b)
// 	if err != nil {
// 		return nil, err
// 	}

// 	return b, nil
// }

// func GenerateRandomString(s int) (string, error) {
// 	b, err := GenerateRandomBytes(s)
// 	return base64.URLEncoding.EncodeToString(b), err
// }

// func (c *MainController) Register() {
// 	c.Data["Form"] = &(models.User{})
// }
