CREATE TABLE 고객사 (
    고객사번호 INT(10) NOT NULL AUTO_INCREMENT,
    고객사이름 CHAR(20) NOT NULL,
    고객사지점위치 CHAR(100),
    고객사전화번호 CHAR(30),
    PRIMARY KEY (고객사번호)
);

CREATE TABLE 직원 (
    직원번호 INT(10) NOT NULL,
    직원이름 CHAR(10) NOT NULL,
    생년월일 DATE,
    직원전화번호 CHAR(20) NOT NULL,
    PRIMARY KEY (직원번호)
);

CREATE TABLE 식기세트정보 (
    식기세트번호 INT(10) NOT NULL,
    유형 CHAR(1) NOT NULL,
    대여가능여부 CHAR(1) NOT NULL DEFAULT 'Y',
    PRIMARY KEY (식기세트번호)
);

CREATE TABLE 요청서 (
    요청서번호 INT(10) NOT NULL AUTO_INCREMENT,
    요청신청일자 DATE,
    수령일자 DATE,
    A세트신청수량 INT(3),
    B세트신청수량 INT(3),
    C세트신청수량 INT(3),
    고객사번호 INT(10),
    직원번호 INT(10),
    PRIMARY KEY (요청서번호),
    FOREIGN KEY (고객사번호) REFERENCES 고객사(고객사번호),
    FOREIGN KEY (직원번호) REFERENCES 직원(직원번호)
);

CREATE TABLE 대여정보 (
    대여번호 INT(5) NOT NULL AUTO_INCREMENT,
    식기세트번호 INT(10),
    요청서번호 INT(10),
    PRIMARY KEY (대여번호),
    FOREIGN KEY (식기세트번호) REFERENCES 식기세트정보(식기세트번호),
    FOREIGN KEY (요청서번호) REFERENCES 요청서(요청서번호)
);

CREATE TABLE 차량정보 (
    차량번호 INT(10) NOT NULL,
    차종 CHAR(10) NOT NULL,
    구입일자 DATE,
    PRIMARY KEY (차량번호)
);

CREATE TABLE 배차정보 (
    배차번호 INT(5) NOT NULL AUTO_INCREMENT,
    차량번호 INT(10),
    요청서번호 INT(10),
    PRIMARY KEY (배차번호),
    FOREIGN KEY (차량번호) REFERENCES 차량정보(차량번호),
    FOREIGN KEY (요청서번호) REFERENCES 요청서(요청서번호)
);