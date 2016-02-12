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

func SetupConstants() {
	setupDevelopmentContants()
}

func setupDevelopmentConstants() {
	log := NewLogger(100000)
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
}
