<?php
/**
 * 类名最好用驼峰命名法
 * 类名不能与数字开头
 * 类名不区分大小写
 * 成员属性可以有值，也可以没有值，成员属性是静态属性
 * *******************************************************************
 * 类得成员属性/成员方法必须有权限控制符，权限控制符总共有三个（作用:主要用来保护数据安全）：
 * （1）public（公共权限）：在任何地方都可以访问，主要指类得内部、类外部、子类中都可以访问
 * （2）protected（受保护的权限)：只能在本类中、字类中被访问，在类外不能访问
 * （3）private（私有权限）：只能在本类中被访问，在类外、之类中都无权访问
 * *******************************************************************
 * 成员方法（一个方法完成一个小功能）：
 * （1）成员方法，一定是哪个对象的方法，不能单独存在
 * （2）成员方法要加权限控制符，普通函数不需要加
 * （3）成员方法可以省略权限控制符，默认public，建议不要省略
 * *******************************************************************
 * 类可以产生N个对象
 * 类几乎不占用内存，但每个对象都要占用内存
 * 对象（类要产生对象，只有对象才能够干活，在能够明确责任跟义务）
 *
 * 一个类，里面只能有成员属性或者成员方法，其他的如变量等是不能存在的，而成员属性及成员方法
 * 只能让对象来调用
 * *******************************************************************
 * 类中定义常量（以对象无关）：
 *  （1）值永远不变，也不能删除，所谓不能修改，是指在一次http请求中不能修改,
 * 也即是一个脚本开始执行后定义的常量是不能改的
 *  （2）在类中定义常量是用const，define定义的是当权脚本中的全局常量
 *  （3）类常量是类的常量，与对象无关，类常量，只能通过类名来调用，类的成员的属性，只能通过对象
 * 来调用，成员由具备了私有，共有，保护三个属性
 *  （4）类名调用类常量：（类名::常量）::叫做范围解析符，对象的东西使用->来访问调用的
 *  （5）类常量在内存中只能存在一份，因为一个类在内存中只有一份，不会随着对象的增加而增加，所所以类常量
 * 可以被所有的对象共享，使用其的好处就是大大节省内存
 *  （6）常量的语法说明：没有权限，在哪里都可以访问，const定义的一般是局部常量，常量名不加$符号，尽量大写
 * 常量的值只能是一个固定的值，不能是一个变量
 * *******************************************************************
 * 静态属性与静态方法（static）：
 *  （1）被static修饰的属性就是静态属性，修饰的方法就是静态方法
 *  （2）静态属性静态方法是属于类的属性与方法，与对象无关，与类相关，因此静态属性跟静态方法也只有一份
 *  （3）静态属性静态方法的访问方式：类名::静态属性名或静态方法名，目的也是节省内存
 *  （4)其跟类常量一样，可以被所有对象共享，但是其值是可以被改变的
 *  （5）对象也可能访问静态属性和静态方法的，如：$p1::$name;//对象访问静态属性。$p1->tell();//对象可以访问静态方法
 * *******************************************************************
 * 如何区分静态属性跟类常量：
 *  （1）类常量在脚本周期类永远不会变，但是静态属性是可以变
 *  （2）静态属性和静态方法是有权限控制的，而类常量没有,
 *  （3）修饰静态属性和静态方法以及权限的关键字可以不在乎顺序
 * *******************************************************************
 * 类名内部替换，方便修改类名：
 *  （1）self关键字，代表当前类,当然只能在类中使用，类外肯定会要用类名
 *  （2）$this代表当前对象，调用成员属性，成员方法（对象的东西）
 *  （3）self代表当前类，调用类的常量，静态属性，静态方法（类的东西）
 *  （4）$this用->来调用成员属性及成员方法，Self用::调用类的常量，静态属性及静态方法
 *  （5）$this只能用在成员方法中，self可以用在成员方法及静态方法中
 */
class Student{
  // 定义学生在线人数
  private static $count = 0;
  // 定义类常量
  const HISTORY = '第五中学';
  // 成员属性
  public $name = '文君';
  public $age = '28';
  public $sex = '男';
  private $money = 1280;
  // 定义静态属性(静态属性或返方法有权限）
  public static $title = '我是共有静态属性';
  // 成员私有方法
  private function showHtml() {
    return '<h1>我是私有方法返回的</h1>';
  }
  // 在构造函数里计算上线的学生
  public function __construct(){
    self::$count++;
  }
  // 在析构函数里面计算下线的学生
  public function __destruct(){
    // TODO: Implement __destruct() method.
    self::$count--;
  }
  // 定义一个公共的成员方法，查看当前在线人数,一个方法只做一件事
  public function showCount() {
    echo '当前在线人数是：'.self::$count.'人';
  }
  // 成员共有方法
  public function showInfo() {
  // return ['name'=>$this->name,'age'=>$this->age,'sex'=>$this->sex];
    $str = "{$this->name}有{$this->money}万人民币";
    $str.= $this->showHtml();
    echo $str;
  }
  // 静态私有方法
  private static function setTitle() {
    return '我是私有静态方法';
  }
  // 定义一个成员方法来释放常量
  public function showSchool() {
    // 这里，由于双引号只能解析变量，因此类常量的访问只能用拼接了
    echo self::HISTORY;
  }
  // 定义一个成员公共方法来释放静态私属性与静态方法
  public function showTitle() {
    $str = self::$title;
    $str.= self::setTitle();
    echo $str;
  }
}

