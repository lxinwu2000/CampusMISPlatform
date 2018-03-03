#机构信息表
drop table organizeinfo;
create table organizeinfo(
  rid int auto_increment primary key,#记录id
  cnname varchar(256) not null unique key,#中文名称
  enname varchar(256) null,#英文名称
  phone varchar(256) null,#电话
  postcode varchar(256) null,#邮编
  website varchar(256) null,#网址
  address text null,#地址
  Legalrepresentative varchar(256) null,#法人
  email varchar(256) null,#邮箱
  logopath varchar(256) null,#logo图片路径
  schoolmotto varchar(256) null,#校训
  businessphilosophy varchar(256) null,#经营理念
  servicepurpose varchar(256) null,#服务宗旨
  createuser int not null,#创建用户id
  createtime datetime not null default now(),#创建时间
  status int not null default 0,#状态，0:正常;1:无效
  remark varchar(256) null #备注
);

#版权信息表
drop table copyrightinfo;
create table copyrightinfo(
  rid int auto_increment primary key,#记录id
  reserved varchar(256) null,#版权所有
  ipbeiannumber varchar(256) null,#ip/域名备案号
  ipbeianhref varchar(256) null,#ip/域名备案链接
  policebeiannumber varchar(256) not null,#公安机关备案号
  policebeianhref varchar(256) not null,#公安机关备案链接
  techsupport varchar(256) null,#技术支持
  supporthref varchar(256) null,#技术支持链接
  supportphone varchar(256) null,#技术支持电话
  supportemail varchar(256) null,#技术支持邮箱
  createuser int not null,#创建用户id
  createtime datetime not null default now(),#创建时间
  status int not null default 0,#状态，0:正常;1:无效
  remark varchar(256) null #备注
);

#职务表
drop table positions;
create table positions(
  rid int auto_increment primary key,#记录id
  cnname varchar(256) not null unique key,#中文名称
  enname varchar(256) null,#英文名称
  introduce mediumtext null,#简介
  createuser int not null,#创建用户id
  createtime datetime not null default now(),#创建时间
  status int not null default 0,#状态，0:正常;1:无效
  remark varchar(256) null#备注
);

#教师信息表
drop table teachers;
create table teachers(
  rid int auto_increment primary key,#记录id
  number varchar(256) not null unique key,#教工编号
  idcard varchar(256) null,#身份证号
  cnname varchar(256) not null,#中文名称
  enname varchar(256) null,#英文名称
  office varchar(256) null,#办公室
  photopath varchar(256) null,#照片路径
  birthday datetime null,#生日
  entrydate datetime null,#入职日期
  educationlevel int null,#学历等级，1、博士后;2、博士;3、硕士;4、研究生;5、大学本科;6、大学专科（大专）;7、高中/职中/中专;8、初中;9、小学;
  graduateinstitutions varchar(256) null,#毕业院校
  workingyears int null,#工龄
  createuser int not null,#创建用户id
  createtime datetime not null default now(),#创建时间
  status int not null default 0,#状态，0:正常;1:无效
  remark varchar(256) null#备注
);

#部门表
drop table departments;
create table departments(
  rid int auto_increment primary key,#记录id
  parentid int null,#上级部门
  cnname varchar(256) not null unique key,#中文名称
  enname varchar(256) null,#英文名称
  introduce mediumtext null,#简介
  head int not null,#负责人id
  createuser int not null,#创建用户id
  createtime datetime not null default now(),#创建时间
  status int not null default 0,#状态，0:正常;1:无效
  remark varchar(256) null#备注
);

#教师简历表
drop table teacherintroduce;
create table teacherintroduce(
  rid int auto_increment primary key,#记录id
  teacherid int not null,#教师id
  introduce mediumtext not null,#事迹介绍
  positionaltitles varchar(256) null,#职称/奖励/证书
  evaluationdate datetime null,#职称评定日期/获奖日期
  createuser int not null,#创建用户id
  createtime datetime not null default now(),#创建时间
  status int not null default 0,#状态，0:正常;1:无效
  remark varchar(256) null#备注
);

#教师联系方式表
drop table teachercontact;
create table teachercontact(
  rid int auto_increment primary key,#记录id
  teacherid int not null,#教师id
  phone varchar(256) null,#电话
  email varchar(256) null,#邮箱
  qq varchar(256) null,#qq账号
  wechat varchar(256) null,#微信账号
  alipay varchar(256) null,#支付宝账号
  address text null,#地址
  createuser int not null,#创建用户id
  createtime datetime not null default now(),#创建时间
  status int not null default 0,#状态，0:正常;1:无效
  remark varchar(256) null#备注
);

#教师职务关系表
drop table teacherpositionrelation;
create table teacherpositionrelation(
  rid int auto_increment primary key,#记录id
  teacherid int not null,#教师id
  positionid int not null,#职务id
  createuser int not null,#创建用户id
  createtime datetime not null default now(),#创建时间
  status int not null default 0,#状态，0:正常;1:无效
  remark varchar(256) null#备注
);

#教师部门关系表
drop table teacherdepartmentrelation;
create table teacherdepartmentrelation(
  rid int auto_increment primary key,#记录id
  teacherid int not null,#教师id
  departmentid int null,#部门id
  createuser int not null,#创建用户id
  createtime datetime not null default now(),#创建时间
  status int not null default 0,#状态，0:正常;1:无效
  remark varchar(256) null#备注
);

#年级表
drop table grades;
create table grades(
  rid int auto_increment primary key,#记录id
  cnname varchar(256) not null unique key,#中文名称
  enname varchar(256) null,#英文名称
  head int null,#负责人id
  createuser int not null,#创建用户id
  createtime datetime not null default now(),#创建时间
  status int not null default 0,#状态，0:正常;1:无效
  remark varchar(256) null#备注
);

#专业设置表
drop table specialities;
create table specialities(
  rid int auto_increment primary key,#记录id
  cnname varchar(256) not null unique key,#中文名称
  enname varchar(256) null,#英文名称
  createuser int not null,#创建用户id
  createtime datetime not null default now(),#创建时间
  status int not null default 0,#状态，0:正常;1:无效
  introduce mediumtext null,#简介
  remark varchar(256) null#备注
);

#课程表
drop table courses;
create table courses(
  rid int auto_increment primary key,#记录id
  cnname varchar(256) not null unique key,#中文名称
  enname varchar(256) null,#英文名称
  createuser int not null,#创建用户id
  createtime datetime not null default now(),#创建时间
  status int not null default 0,#状态，0:正常;1:无效
  remark varchar(256) null#备注
);

#专业课程关系表
drop table specializedcourserelation;
create table specializedcourserelation(
  rid int auto_increment primary key,#记录id
  specializedid int not null,#专业id
  courseid int not null,#课程id
  createuser int not null,#创建用户id
  createtime datetime not null default now(),#创建时间
  status int not null default 0,#状态，0:正常;1:无效
  remark varchar(256) null#备注
);


#年级课程关系表
drop table gradecourserelation;
create table gradecourserelation(
  rid int auto_increment primary key,#记录id
  gradeid int not null,#年级id
  courseid int not null,#课程id
  createuser int not null,#创建用户id
  createtime datetime not null default now(),#创建时间
  status int not null default 0,#状态，0:正常;1:无效
  remark varchar(256) null#备注
);

#班级表
drop table classes;
create table classes(
  rid int auto_increment primary key,#记录id
  gradeid int,#所属年级Id
  headmasterid int null,#班主任id
  cnname varchar(256) not null unique key,#中文名称
  enname varchar(256) null unique key,#英文名称
  createuser int not null,#创建用户id
  createtime datetime not null default now(),#创建时间
  status int not null default 0,#状态，0:正常;1:无效
  remark varchar(256) null#备注
);

#教师班级关系表
drop table teacherclassrelation;
create table teacherclassrelation(
  rid int auto_increment primary key,#记录id
  teacherid int not null,#教师id
  classid int not null,#班级id
  createuser int not null,#创建用户id
  createtime datetime not null default now(),#创建时间
  status int not null default 0,#状态，0:正常;1:无效
  remark varchar(256) null#备注
);

#教师课程关系表
drop table teachercourserelation;
create table teachercourserelation(
  rid int auto_increment primary key,#记录id
  teacherid int not null,#教师id
  courseid int not null,#课程id
  createuser int not null,#创建用户id
  createtime datetime not null default now(),#创建时间
  status int not null default 0,#状态，0:正常;1:无效
  remark varchar(256) null#备注
);

#班级课程关系表
drop table classcourserelation;
create table classcourserelation(
  rid int auto_increment primary key,#记录id
  classid int not null,#班级id
  courseid int not null,#课程id
  createuser int not null,#创建用户id
  createtime datetime not null default now(),#创建时间
  status int not null default 0,#状态，0:正常;1:无效
  remark varchar(256) null#备注
);

#学生表
drop table students;
create table students(
  rid int auto_increment primary key,#记录id
  studentnumber varchar(256) not null,#学号
  idcard varchar(256) null,#身份证号
  classid int not null,#所属班级id
  cnname varchar(256) not null unique key,#中文名称
  enname varchar(256) null unique key,#英文名称
  createuser int not null,#创建用户id
  createtime datetime not null default now(),#创建时间
  status int not null default 0,#状态，0:正常;1:无效
  remark varchar(256) null#备注
);

#学生联系方式表
drop table studentcontact;
create table studentcontact(
  rid int auto_increment primary key,#记录id
  studentid int not null,#学生id
  parents varchar(256) null,#家长姓名
  relationship int null,#关系，1:自己;2:父亲;3:母亲;4:爷爷;5:奶奶;6:舅舅;7:姨姨;8:姑姑;9:叔叔;
  idcard varchar(256) null,#身份证号
  phone varchar(256) null,#电话
  email varchar(256) null,#邮箱
  qq varchar(256) null,#qq账号
  wechat varchar(256) null,#微信账号
  alipay varchar(256) null,#支付宝账号
  address text null,#地址
  createuser int not null,#创建用户id
  createtime datetime not null default now(),#创建时间
  status int not null default 0,#状态，0:正常;1:无效
  remark varchar(256) null#备注
);

#新闻表
drop table news;
create table news(
  rid int auto_increment primary key,#记录id
  source varchar(256) null,#来源
  author varchar(256) null,#作者
  title varchar(256) null,#标题
  summary text null,#摘要
  keywords text null,#关键字
  contents mediumtext not null,#内容
  createuser int not null,#创建用户id
  createtime datetime not null default now(),#创建时间
  pageviews int not null default 0,#浏览量
  status int not null default 0,#状态，0:正常;1:无效
  remark varchar(256) null#备注
);

#校长致辞表
drop table speechs;
create table speechs(
  rid int auto_increment primary key,#记录id
  contents mediumtext not null,#内容
  photopath varchar(256) null,#照片路径
  createuser int not null,#创建用户id
  createtime datetime not null default now(),#创建时间
  status int not null default 0,#状态，0:正常;1:无效
  remark varchar(256) null#备注
);

#发展历程表
drop table developmenthis;
create table developmenthis(
  rid int auto_increment primary key,#记录id
  eventdate datetime not null,#事件日期
  contents mediumtext not null,#内容
  createuser int not null,#创建用户id
  createtime datetime not null default now(),#创建时间
  status int not null default 0,#状态，0:正常;1:无效
  remark varchar(256) null#备注
);

#领导信息
drop table leaders;
create table leaders(
  rid int auto_increment primary key,#记录id
  iscurrent int not null default 0,#任职状态，0:现任;1:非现任
  teacherid int null,#教师id
  cnname varchar(256) not null,#名称
  servicefrom datetime not null,#任职开始日期
  serviceto datetime not null,#任职结束日期
  achievement mediumtext null,#成就/政绩介绍
  introduce mediumtext null,#个人简历
  createuser int not null,#创建用户id
  createtime datetime not null default now(),#创建时间
  status int not null default 0,#状态，0:正常;1:无效
  remark varchar(256) null#备注
);

#成绩表
drop table scores;
create table scores(
  rid int auto_increment primary key,#记录id
  studentid int not null,#学生id
  courseid int not null,#课程id
  score decimal(18,2) not null,#分数
  examdate datetime not null,#考试日期
  createuser int not null,#创建用户id
  createtime datetime not null default now(),#创建时间
  status int not null default 0,#状态，0:正常;1:无效
  remark varchar(256) null#备注
);

#信箱表
drop table mailboxs;
create table mailboxs(
  rid int auto_increment primary key,#记录id
  receiverid int not null,#收件人id
  receivername int not null,#收件人名称
  sendername varchar(256) not null,#写信人名称
  senderaddress varchar(256) null,#写信人地址
  senderphone varchar(256) not null,#写信人电话
  senderemail varchar(256) null,#写信人邮箱
  subject varchar(256) not null,#主题
  message mediumtext not null,#信件内容
  ispublic int not null default 1,#是否公开,0:公开;1:不公开
  handleuserid int null,#办理用户id
  handletime datetime null,#办理/处理时间
  responsemessage mediumtext null,#反馈结果
  createuser int not null,#创建用户id
  createtime datetime not null default now(),#创建时间
  status int not null default 0,#状态，0:提交;1:无效;2:办结
  remark varchar(256) null#备注
);

#民意征集信息发布
drop table opinionpublish;
create table opinionpublish(
  rid int auto_increment primary key,#记录id
  publisherid int not null,#发布人id
  publishername varchar(256) not null,#发布人名称
  subject varchar(256) not null,#主题
  detail mediumtext not null,#详情
  fromdate datetime null,#意见收集开始时间
  todate datetime null,#意见收集结束时间
  createtime datetime not null default now(),#创建时间
  status int not null default 0,#状态，0:正常;1:无效;
  remark varchar(256) null#备注
);

#民意征集结果
drop table opinioncollect;
create table opinioncollect(
  rid int auto_increment primary key,#记录id
  opinionpublishid int not null,#发布id
  userid int null,#用户id
  ip varchar(256) null,#ip地址
  suggestion mediumtext not null,#建议/意见
  createtime datetime not null default now(),#创建时间
  status int not null default 0,#状态，0:正常;1:无效;
  remark varchar(256) null#备注
);

#投票评优信息发布
drop table voteappraisal;
create table voteappraisal(
  rid int auto_increment primary key,#记录id
  publisherid int not null,#发布人id
  publishername varchar(256) not null,#发布人名称
  groupdesc varchar(256) null,#评优信息分组
  subject varchar(256) not null,#主题
  detail mediumtext not null,#详情
  fromdate datetime null,#投票开始时间
  todate datetime null,#投票结束时间
  createtime datetime not null default now(),#创建时间
  status int not null default 0,#状态，0:正常;1:无效;
  poll int not null default 0,#票数
  remark varchar(256) null#备注
);

#投票结果明细
drop table votedetail;
create table votedetail(
  rid int auto_increment primary key,#记录id
  voteappraisalid int not null,#评优信息id
  userid int null,#用户id
  ip varchar(256) null,#ip地址
  createtime datetime not null default now(),#创建时间
  status int not null default 0,#状态，0:正常;1:无效;
  remark varchar(256) null#备注
);

#招生简章
drop table studentrecruitmentbrochure;
create table studentrecruitmentbrochure(
  rid int auto_increment primary key,#记录id
  content mediumtext null,#内容详情
  imgpath varchar(256) null,#图片路径
  createuser int not null,#创建用户id
  createtime datetime not null default now(),#创建时间
  status int not null default 0,#状态，0:正常;1:无效;
  remark varchar(256) null#备注
);

#入学登记
drop table registration;
create table registration(
  rid int auto_increment primary key,#记录id
  name varchar(256) not null,#名称
  address varchar(256) null,#地址
  phone varchar(256) not null,#电话
  email varchar(256) null,#邮箱
  regmessage mediumtext not null,#登记信息
  score decimal(18,2) not null,#分数
  createtime datetime not null default now(),#创建时间
  status int not null default 0,#状态，0:正常;1:无效;
  remark varchar(256) null#备注
);

#招聘计划
drop table recruitplan;
create table recruitplan(
  rid int auto_increment primary key,#记录id
  positionid int null,#岗位id
  positionname varchar(256) null,#岗位名称
  totalnumber int not null,#招聘人数
  salarymin decimal(18,2) not null default 0,#薪资-最小值
  salarymax decimal(18,2) not null default 0,#薪资-最大值
  educationlevel varchar(256) null,#学历要求
  workaddress varchar(256) null,#工作地点
  experiencemin int null default 0,#工作经验要求-最小值
  experiencemax int null default 0,#工作经验要求-最大值
  positiondesc mediumtext not null,#职位描述
  requirement mediumtext not null,#任职要求描述
  fromdate datetime null,#开始时间
  todate datetime null,#结束时间
  createuser int not null,#创建用户id
  createtime datetime not null default now(),#创建时间
  status int not null default 0,#状态，0:正常;1:无效;
  remark varchar(256) null#备注
);

#应聘信息
drop table candidates;
create table candidates(
  rid int auto_increment primary key,#记录id
  positionid int null,#岗位id
  name varchar(256) not null,#名称
  address varchar(256) null,#地址
  phone varchar(256) not null,#电话
  email varchar(256) not null,#邮箱
  resume mediumtext not null,#简历
  filepath varchar(256) null,#文件路径
  createuser int not null,#创建用户id
  registertime datetime not null default now(),#登记时间
  status int not null default 0,#状态，0:正常;1:无效;
  remark varchar(256) null#备注
);

#文件上传下载
drop table files;
create table files(
  rid int auto_increment primary key,#记录id
  filename varchar(256) not null,#文件名称
  filedesc varchar(256) null,#文件描述
  filepath varchar(256) not null,#文件路径
  createuser int not null,#创建用户id
  uploadtime datetime not null default now(),#上传时间
  content mediumtext null,#文件内容介绍
  downtimes int not null default 0,#下载次数
  status int not null default 0,#状态，0:正常;1:无效;
  remark varchar(256) null#备注
);

#校园生活
drop table campuslife;
create table campuslife(
  rid int auto_increment primary key,#记录id
  author varchar(256) null,#作者
  title varchar(256) null,#标题
  summary text null,#摘要
  keywords text null,#关键字
  contents mediumtext not null,#内容
  coverphoto varchar(256) null,#封面图片
  createuser int not null,#创建用户id
  createtime datetime not null default now(),#创建时间
  status int not null default 0,#状态，0:正常;1:无效;
  remark varchar(256) null#备注
);

#校园风光
drop table campusscenery;
create table campusscenery(
  rid int auto_increment primary key,#记录id
  author varchar(256) null,#作者
  title varchar(256) null,#标题
  summary text null,#摘要
  keywords text null,#关键字
  contents mediumtext not null,#内容
  coverphoto varchar(256) null,#封面图片
  createuser int not null,#创建用户id
  createtime datetime not null default now(),#创建时间
  status int not null default 0,#状态，0:正常;1:无效;
  remark varchar(256) null#备注
);

#校园视频
drop table campusvideo;
create table campusvideo(
  rid int auto_increment primary key,#记录id
  author varchar(256) null,#作者
  title varchar(256) null,#标题
  contents mediumtext not null,#视频介绍
  filepath varchar(256) null,#文件路径
  createuser int not null,#创建用户id
  createtime datetime not null default now(),#创建时间
  status int not null default 0,#状态，0:正常;1:无效;
  remark varchar(256) null#备注
);

#日志表
drop table logs;
create table logs(
  rid int auto_increment primary key,#记录id
  userid int not null,#操作员id
  opttype int not null,#操作类型，1:修改；2:删除
  action varchar(256) not null,#执行动作
  recid int not null,#操作的记录id
  tbname varchar(256) not null,#操作的数据表名
  oldrec mediumtext not null,#原值
  newrec mediumtext null,#新值,删除操作此项为null
  createtime datetime not null default now(),#创建时间
  remark varchar(256) null#备注
);