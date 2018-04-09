package com.cafe24.qkrnsfjqm.dao;

import java.util.ArrayList;
import java.util.HashMap;
import java.util.List;

import javax.servlet.http.HttpServletRequest;
import javax.servlet.http.HttpSession;

import org.mybatis.spring.SqlSessionTemplate;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Repository;

import com.cafe24.qkrnsfjqm.dto.UsersDto;

@Repository("usersDao")
public class UserDao {
	
	@Autowired
    private SqlSessionTemplate sqlSession;	

	public List<UsersDto> getUsers() throws Exception {
		// TODO Auto-generated method stub
		return sqlSession.selectList("users.getUsers");
	}

	public int insertUser(HashMap<String, Object> memParam) {
		// TODO Auto-generated method stub
		
		return sqlSession.insert("users.insertUsers", memParam);
	}

	public HashMap<String, Object> selectUser(HashMap<String, Object> params) {
		// TODO Auto-generated method stub
		return sqlSession.selectOne("users.selectUser", params);
	}





}
