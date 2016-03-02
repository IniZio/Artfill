package routers

import (
	"artfill_lab/controllers"
	"github.com/astaxie/beego"
)

func init() {
	beego.Router("/", &controllers.MainController{}, "*:Index")
	beego.Router("/404", &controllers.MainController{}, "*:All404")
	beego.Router("/login/:back", &controllers.MainController{}, "get,post:Login")
	beego.Router("/logout", &controllers.MainController{}, "get:Logout")
	beego.Router("/verify/:uuid", &controllers.MainController{}, "get:Verify")
	beego.Router("/register", &controllers.MainController{}, "get,post:Register")
}
