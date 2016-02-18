package models

import (
	"github.com/astaxie/beego/orm"
	_ "github.com/go-sql-driver/mysql"
)

type Shop struct {
	Id   int
	Name string
}

func init() {
	orm.RegisterModel(new(Shop))
}
