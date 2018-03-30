package com.cafe24.qkrnsfjqm.service;

import java.util.List;

import javax.annotation.Resource;

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

}
