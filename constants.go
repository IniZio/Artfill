package config

import (
	"github.com/kelseyhightower/envconfig"
	"os"
)

type constants struct {
	ListenAddress     string `envconfig:"SERVER_ADDR"`
	LoginRedirectPath string `envconfig:"SERVER_REDIRECT_PATH"`

	Dbaddr     string `envconfig:"DATABASE_ADDR"`
	DbDatabase string `envconfig:"DATABASE_NAME"`
	DbUsername string `envconfig:"DATABASSE_USERNAME"`
	DbPassword string `envconfig:"DATABASE_PASSWORD"`
}
