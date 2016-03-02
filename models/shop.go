package models

import (
	"artfill_lab/config"

	"github.com/astaxie/beego/orm"
	_ "github.com/go-sql-driver/mysql"
)

type Shop struct {
	Id   int
	Name string
}

func init() {
	orm.RegisterModelWithPrefix(config.Constant.DBPrefix, new(Shop))
}

func (s *Shop) TableName() string {
	return "Shop"
}
