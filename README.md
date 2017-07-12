# PHP CodeIgniter
## CodeIgniter를 이용한 게시판 프로젝트
> MVC 모델로 작성되었으며 Controller, Model, View로 나누어서 기술됨. date: 2017/07/12
### 1. Controller  

> #### 1) Board_c
>> #### write()
- 세션정보의 유무에 따라서 게시글 작성 뷰 컨트롤

>> #### insert()
- 게시글 제목, 내용, 작성자id를 post형식으로 전달받아 insert_contents모델로 연결..
- 첨부파일이 있을 때 첨부파일의 정보를 upload_file 테이블에 입력

>> #### index()
- 페이지네이션 셋팅 및 게시판 목록 뷰 연결

>> #### detail()
- url에 담겨있는 id값을 가져와 해당 글의 내용을 보여주는 뷰와 연결

>> #### update()
- 게시글 수정 뷰와 연결

>> #### delete()
- 게시글 삭제 액션

> #### 2) User
>> #### index()
- 로그인페이지 메소드

>> #### new_check()
- 아이디 중복검사 메소드

>> #### join()
- 회원가입 페이지 뷰 메소드

>> #### logout()
- 로그아웃 메소드

>> #### check()
- 로그인시 아이디와 패스워드가 올바르게 들어왔는지 확인하는 메소드

>> #### account()
- 회원가입시 입력된 정보를 모델로 전달

### 2. Model
> #### 1) Board_m

>> #### get_list($id, $count)
- $id를 입력받아 해당 게시판 id로부터 4개의 행을 결과값으로 리턴

>> #### get_all()
- board 테이블의 모든 행을 갯수를 리턴

>> #### update_hits($id)
- 게시글을 읽었을 때 조회수를 증가시켜줌

>> #### load_data($id)
- $id로 검색하여 게시글 모든 내용 리턴

>> #### insert_contents($input_data)
- $input_data로 넘어온 데이터를 board 테이블에 입력 후 쿼리실행결과와 쿼리가 삽입된 행의 id값을 리턴

>> #### insert_file($data)
- 업로드된 파일의 정보를 **upload_file** 테이블에 입력

>> #### id_check($dataSet)
- 게시글 삭제 시 글을 작성한 사용자와 삭제하려는 사용자가 같은지 판단하고 true or false 리턴

>> #### delete($id)
- 넘어온 인자 $id값으로 검색하여 해당 결과 행을 **board** 테이블에서 삭제

> #### 2) User_m

>> #### get_result($auth)
- 인자로 넘어온 유저아이디로 user_data 테이블을 검색해서 **user_pw** 값을 가져온다. 인자로 넘어온 패스워드와 테이블에 입력되어있는 패스워드가 동일한지 판단하여 리턴

>> #### check_user($id)
- 인자로 넘어온 유저아이디를 user_data 테이블에서 검색하여 쿼리결과가 있으면 true, 없으면 false 리턴

>> #### input_user($input_data)
- 회원가입시 입력받은 패스워드는 **password_hash** 함수로 암호화하고, 나머지 입력값들과 함께 user_data 테이블에 입력하게된다.

### 3. View
> #### login
- 로그인화면 뷰

> #### join
- 회원가입 뷰

> #### b_list
- 게시판 글목록 뷰

> #### b_write
- 게시판 글작성 뷰

> #### b_update
- 게시판 글수정 뷰

> #### header
- 모든 뷰에서 공통되는 html head부분 태그 정의

> #### logout
- 로그아웃 alert 뷰
