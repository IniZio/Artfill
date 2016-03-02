package config

import (
	"github.com/astaxie/beego/logs"
	"github.com/kelseyhightower/envconfig"
	"os"
	"strings"
)

type constants struct {
	ListenAddress     string `envconfig:"SERVER_ADDR"`
	LoginRedirectPath string `envconfig:"SERVER_REDIRECT_PATH"`

	Dbaddr     string `envconfig:"DATABASE_ADDR"`
	DbDatabase string `envconfig:"DATABASE_NAME"`
	DbUsername string `envconfig:"DATABASSE_USERNAME"`
	DbPassword string `envconfig:"DATABASE_PASSWORD"`
	DBPrefix   string `envconfig:"DATABASE_PREFIX"`
}

var Constant = constants{}
var MySQLConn string

func SetupConstants() {
	setupDevelopmentConstants()
	log := logs.NewLogger(100000)
	log.SetLogger("console", "")

	if val := os.Getenv("DEPLOYMENT_ENV"); strings.ToLower(val) == "production" {
		setupProductionConstants()
	} else if val == "test" {
		setupTestConstants()
	}
	err := envconfig.Process("artfill_lab", &Constant)
	if err != nil {
		log.Error(err.Error())
	}
	MySQLConn = Constant.DbUsername + ":" + Constant.DbPassword + "@/" + Constant.DbDatabase + "?charset=utf8"
}

func setupDevelopmentConstants() {
	Constant.ListenAddress = "http://localhost:8080"
	Constant.LoginRedirectPath = "http://localhost:8080"

	Constant.Dbaddr = "127.0.0.1:3306"
	Constant.DbDatabase = "artfill_lab"
	Constant.DbUsername = "root"
	Constant.DbPassword = "toor"
	Constant.DBPrefix = "artfill_lab"
}

func setupProductionConstants() {

}

func setupTestConstants() {

}
