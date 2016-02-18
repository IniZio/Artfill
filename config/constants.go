package config

import (
	"github.com/astaxie/beego/logs"
	"github.com/kelseyhightower/envconfig"
	"os"
	"strings"
)

type Constants struct {
	ListenAddress     string `envconfig:"SERVER_ADDR"`
	LoginRedirectPath string `envconfig:"SERVER_REDIRECT_PATH"`

	Dbaddr     string `envconfig:"DATABASE_ADDR"`
	DbDatabase string `envconfig:"DATABASE_NAME"`
	DbUsername string `envconfig:"DATABASSE_USERNAME"`
	DbPassword string `envconfig:"DATABASE_PASSWORD"`
}

var constants = Constants{}
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
	err := envconfig.Process("artfill", &constants)
	if err != nil {
		log.Error(err.Error())
	}
	MySQLConn = constants.DbUsername + ":" + constants.DbPassword + "@/" + constants.DbDatabase + "?charset=utf8"
}

func setupDevelopmentConstants() {
	constants.ListenAddress = "http://localhost:8080"
	constants.LoginRedirectPath = "http://localhost:8080"

	constants.Dbaddr = "127.0.0.1:3306"
	constants.DbDatabase = "artfill"
	constants.DbUsername = "root"
	constants.DbPassword = "toor"
}

func setupProductionConstants() {

}

func setupTestConstants() {

}
