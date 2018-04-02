<%@ page language="java" contentType="text/html; charset=UTF-8" pageEncoding="UTF-8"%>
<%@ include file="../include/header.jsp" %>
<link href="../resources/css/memberJoin.css" rel="stylesheet" type="text/css">
<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    
<!--  content start-->
<div id="login-page" class="row text-center" >
  <div class="col s12 z-depth-4 card-panel">
    <form class="login-form" method="POST">
      <div class="row">
        <div class="input-field col s12 center">
          <h4>Register</h4>
          <p class="center">가입 하시면 모든 서비스를 제공 받을 수 있습니다</p>
          <input id="checkJoin" name="checkJoin" value="1" type="hidden"/>
        </div>
      </div>

      <div class="row margin">
        <div class="input-field col s12">
          <!-- <i class="mdi-social-person-outline prefix"></i> -->
          <i class="material-icons prefix">account_circle</i>
          <input id="username" name="username" type="text" placeholder="이름"/>
        </div>
      </div>

      <div class="row margin">
        <div class="input-field col s12">
          <!-- <i class="mdi-social-person-outline prefix"></i> -->
          <i class="material-icons prefix">email</i>
          <input id="email" name="email" type="text" style="cursor: auto;"  placeholder="이메일"/>
        </div>
      </div>

      <div class="row margin">
        <div class="input-field col s12">
          <!-- <i class="mdi-action-lock-outline prefix"></i> -->
          <i class="material-icons prefix">vpn_key</i>
          <input id="password" name="password" type="password"  placeholder="비밀번호"/>
        </div>
      </div>

      <div class="row margin">
        <div class="input-field col s12">
          <!-- <i class="mdi-action-lock-outline prefix"></i> -->
          <i class="material-icons prefix">vpn_key</i>
          <input id="password_a" name="cpassword" type="password"  placeholder="비밀번호 확인"/>
        </div>
      </div>
      
      <div class="row margin">
        <div class="input-field col s12">
          <!-- <i class="mdi-action-lock-outline prefix"></i> -->
          <i class="material-icons prefix">smartphone</i>
          <input id="phone" name="phone" type="text"  placeholder="휴대폰 번호"/>
        </div>
      </div>      

      <div class="row">
        <div class="input-field col s12">
          <button type="submit" class="btn waves-effect waves-light col s12">가입하기</button>          
        </div>
        
        <div class="input-field col s12">
          <p class="margin center medium-small sign-up">이미 가입하셨다면!<a href="./login">로그인</a></p>
        </div>
      </div>
    </form>
  </div>
</div>
<!--  content end-->

<%@ include file="../include/footer.jsp" %>