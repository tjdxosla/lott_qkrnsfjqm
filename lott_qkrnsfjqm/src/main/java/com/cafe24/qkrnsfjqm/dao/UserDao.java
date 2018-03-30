package com.cafe24.qkrnsfjqm.dao;

import java.util.List;

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

}
