package models

import (
	"github.com/astaxie/beego/orm"
	_ "github.com/go-sql-driver/mysql"
	"time"
)

type User struct {
	Id         int       `form:"-"`
	Name       string    `form:"username"`
	Password   string    `form:"password"`
	Email      string    `form:"email"`
	IsVerified bool      `form:"-";orm:"default(false)"`
	Created    time.Time `orm:"auto_now_add;type(date)"`
	Updated    time.Time `orm:"auto_now;type(datetime)"`
	// Profile *Profile `orm:"rel(one)"`
}

// type Profile struct {
// 	Id   int
// 	Age  int
// 	User *User `orm:"reverse(one)"`
// }

func init() {
	orm.RegisterModel(new(User))
}

func get_all_reviews(id int) {

}
