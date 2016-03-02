package models

import (
	"artfill_lab/config"
	"github.com/astaxie/beego/orm"
)

type Session struct {
	Id string `orm:"pk"`
}

func init() {
	orm.RegisterModelWithPrefix(config.Constant.DBPrefix, new(Session))
}

func (s *Session) TableName() string {
	return "Session"
}
