package com.cafe24.qkrnsfjqm.service;

import java.util.ArrayList;
import java.util.HashMap;
import java.util.List;

import javax.servlet.http.HttpServletRequest;
import javax.servlet.http.HttpSession;

import com.cafe24.qkrnsfjqm.dto.UsersDto;

public interface UsersService {

	List<UsersDto> getUsers() throws Exception;

	int insertUser(HashMap<String, Object> memParam);

	HashMap<String, Object> selectUser(HashMap<String, Object> params);





	

	

}
