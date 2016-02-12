package routers

import (
	"artfill/controllers"
	"github.com/astaxie/beego"
)

func init() {
	beego.Router("/", &controllers.MainController{}, "*:Index")
	beego.Router("/404", &controllers.MainController{}, "*:All404")
	beego.Router("/login", &controllers.MainController{}, "*:Login")
}
