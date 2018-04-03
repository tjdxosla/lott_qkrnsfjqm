package com.cafe24.qkrnsfjqm.service;

import java.util.ArrayList;
import java.util.HashMap;
import java.util.List;

public interface BoardService {

	List<HashMap<String, Object>> getBoardList() throws Exception;

	int insertWrite(HashMap<String, Object> writeMap);

	HashMap<String, Object> getView(String id);

	int updateEdit(HashMap<String, Object> editMap);

	int delete(HashMap<String, Object> deleteMap);

	void updateHit(HashMap<String, Object> hitMap);

}
