package com.cafe24.qkrnsfjqm.service;

import java.util.ArrayList;
import java.util.HashMap;
import java.util.List;

import com.cafe24.qkrnsfjqm.dto.UsersDto;

public interface UsersService {

	List<UsersDto> getUsers() throws Exception;

	int insertUser(HashMap<String, Object> memParam);

	

}
