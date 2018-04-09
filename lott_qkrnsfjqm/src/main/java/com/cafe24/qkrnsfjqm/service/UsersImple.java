package com.cafe24.qkrnsfjqm.service;

import java.util.ArrayList;
import java.util.HashMap;
import java.util.List;

import javax.annotation.Resource;
import javax.servlet.http.HttpServletRequest;
import javax.servlet.http.HttpSession;

import org.apache.log4j.Logger;
import org.springframework.stereotype.Service;

import com.cafe24.qkrnsfjqm.dao.UserDao;
import com.cafe24.qkrnsfjqm.dto.UsersDto;

@Service("usersService")
public class UsersImple implements UsersService {
	
	Logger log = Logger.getLogger(this.getClass());
	
	@Resource(name="usersDao")
	private UserDao usersDao;

	@Override
	public List<UsersDto> getUsers() throws Exception {
		// TODO Auto-generated method stub
		return usersDao.getUsers();
	}

	@Override
	public int insertUser(HashMap<String, Object> memParam) {
		// TODO Auto-generated method stub
		
		return usersDao.insertUser(memParam);
	}

	@Override
	public HashMap<String, Object> selectUser(HashMap<String, Object> params) {
		// TODO Auto-generated method stub
		
		return usersDao.selectUser(params);
	}








}
