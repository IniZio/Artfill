package models

import (
	"artfill_lab/config"
	"github.com/astaxie/beego/orm"
	_ "github.com/go-sql-driver/mysql"
	"time"
)

type User struct {
	Id         int    `form:"-"`
	Name       string `form:"username"`
	Password   string `form:"password"`
	Email      string `form:"email"`
	VerKey     string
	IsVerified bool      `form:"-";orm:"default(false)"`
	Created    time.Time `orm:"auto_now_add;type(date)"`
	Updated    time.Time `orm:"auto_now;type(datetime)"`
	// Profile *Profile `orm:"rel(one)"`
}

type Profile struct {
	Id   int   `form:"-"`
	Age  int   `form:"age"`
	User *User `form:"-";orm:"reverse(one)"`
}

func init() {
	orm.RegisterModelWithPrefix(config.Constant.DBPrefix, new(User))
}

func (u *User) TableName() string {
	return "User"
}

// func get_all_reviews(id int) {

// }
