<%@ page language="java" contentType="text/html; charset=UTF-8" pageEncoding="UTF-8"%>
<%
	String path  = request.getContextPath().split("/main/")[0];
%>
<!DOCTYPE html>
<html lang="ko">

  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>이번주엔 나다!</title>

    <!-- Bootstrap Core CSS -->
    <link href="../resources/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="../resources/vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,700,300italic,400italic,700italic" rel="stylesheet" type="text/css">
    <link href="../resources/vendor/simple-line-icons/css/simple-line-icons.css" rel="stylesheet">


    <!-- Custom CSS -->
    <link href="../resources/css/stylish-portfolio.min.css" rel="stylesheet">
    
  </head>

  <body id="page-top">
    <!-- Navigation -->
    <a class="menu-toggle rounded" href="#">
      <i class="fa fa-bars"></i>
    </a>
    <nav id="sidebar-wrapper">
      <ul class="sidebar-nav">
        <li class="sidebar-brand">
          <a class="js-scroll-trigger" href="<%=path %>/main/">바군의 로또</a>
        </li>
        <li class="sidebar-nav-item">
          <a class="js-scroll-trigger" href="<%=path %>/main/">Home</a>
        </li>
        <li class="sidebar-nav-item">
        	<a class="js-scroll-trigger" href="<%=path%>/member/login">로그인</a>
          	<a class="js-scroll-trigger" href="<%=path%>/member/join">회원가입</a>  	
        </li>
        <li class="sidebar-nav-item">
          <a class="js-scroll-trigger" href="#services">정밀분석</a>
        </li>
        <li class="sidebar-nav-item">
          <a class="js-scroll-trigger" href="#portfolio">구매대행</a>
        </li>
        <li class="sidebar-nav-item">
          <a class="js-scroll-trigger" href="#contact">관리자에게 문의하기</a>
        </li>
      </ul>
    </nav>

    <!-- Header -->
    <header class="masthead d-flex">
      <div class="container text-center my-auto">
        <h1 class="mb-1">서비스 이용하기!	</h1>
        <h3 class="mb-5">
          <em>바군의 서비스는 회원님들에게만 제공 됩니다.</em>
        </h3>
        <a class="btn btn-primary btn-xl js-scroll-trigger" href="#about">가입하기</a>
      </div>
      <div class="overlay"></div>
    </header>