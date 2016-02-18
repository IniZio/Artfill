package main

import (
	"artfill/models"
	_ "artfill/routers"
	"fmt"
	"github.com/astaxie/beego"
	"github.com/astaxie/beego/orm"
	_ "github.com/astaxie/beego/session/mysql"
	// "github.com/astaxie/beego/plugins/auth"
	// "golang.org/x/oauth2"
	// "github.com/astaxie/beego/session"
	_ "github.com/go-sql-driver/mysql"
	// "log"
)

func init() {
	orm.RegisterDriver("mysql", orm.DRMySQL)
	db_username := "root"
	db_password := "toor"
	db_dbname := "artfill"
	orm.RegisterDataBase("default", "mysql", db_username+":"+db_password+"@/"+db_dbname+"?charset=utf8")
	// beego.BConfig.WebConfig.Session.SessionProvider = "mysql"
	// beego.BConfig.WebConfig.Session.SessionProviderConfig = db_username + ":" + db_password + "@/" + db_dbname + "?charset=utf8"
}

func main() {
	beego.BConfig.WebConfig.Session.SessionOn = true
	orm.Debug = true
	force := false
	verbose := true
	o := orm.NewOrm()
	o.Using("default")
	err := orm.RunSyncdb("default", force, verbose)
	if err != nil {
		beego.Error(err)
	}

	var user models.User
	// user := new(models.User)
	user.Name = "adom"

	// var profile models.Profile
	// // profile := new(models.Profile)
	// user.Profile = &profile
	// profile.Age = 30

	id, err := o.Insert(&user)

	if err == nil {
		fmt.Println(id)
	} else {
		fmt.Println("erro de insert")
		o.Rollback()
	}

	var shop models.Shop
	shop.Name = "Apple"
	_, err = o.Insert(&shop)
	// authPlugin := auth.NewBasicAuthenticator(SecretAuth, "My realm")
	// beego.InsertFilter("*", beego.BeforeExec, authPlugin)

	beego.Run()
	beego.Debug("Running")
}

func SecretAuth(username, password string) bool {
	// The username and password parameters comes from the request header,
	// make a database lookup to make sure the username/password pair exist
	// and return true if they do, false if they dont.

	// To keep this example simple, lets just hardcode "hello" and "world" as username,password
	if username == "hello" && password == "world" {
		return true
	}
	return false
}
