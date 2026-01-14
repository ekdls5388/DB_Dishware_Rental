# B2B 식기 렌탈 서비스 DB 시스템 설계

### 식당을 대상으로 '세척 노동력 절감'과 '주방 공간 최적화'를 제공하는 가상의 B2B 서비스를 위한 DB 설계
설계된 데이터 모델을 바탕으로 MariaDB와 PHP를 활용하여 웹 기반 관리 시스템을 구현했습니다. 
각 기능은 사전에 정의된 모듈(docs 참조)에 맞춰 독립적인 PHP 스크립트로 개발되었습니다.


### 핵심 모듈 및 파일 매핑
**<고객 및 요청 관리 (M1~M8)>**
request_insert.php
request_modify.php
request_delete.php
request_list.php
customer_insert.php
customer_modify.php
customer_delete.php
customer_list.php

**request_delete.php: 요청 취소 시 연관 데이터(재고, 배차) 정합성 유지 로직 포함**

**<자원 및 물류 (M9~M13)>**
set_list.php
rent_list.php
delivery_list.php
employee_view.php


**<기술 스택>**
Database: MariaDB 
Backend: PHP 
Frontend: HTML, CSS 
