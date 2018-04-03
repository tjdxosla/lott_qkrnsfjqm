package com.cafe24.qkrnsfjqm.service;

import java.util.ArrayList;
import java.util.HashMap;
import java.util.List;

import javax.annotation.Resource;

import org.springframework.stereotype.Service;

import com.cafe24.qkrnsfjqm.dao.BoardDao;
@Service("boardService")
public class BoardImple implements BoardService{
	
	@Resource(name="boardDao")
	private BoardDao boardDao;

	@Override
	public List<HashMap<String, Object>> getBoardList() throws Exception {
		// TODO Auto-generated method stub
		return boardDao.getBoardList();
	}

	@Override
	public int insertWrite(HashMap<String, Object> writeMap) {
		// TODO Auto-generated method stub
		return boardDao.insertWrite(writeMap);
	}

	@Override
	public HashMap<String, Object> getView(String id) {
		// TODO Auto-generated method stub
		return boardDao.getView(id);
	}

	@Override
	public int updateEdit(HashMap<String, Object> editMap) {
		// TODO Auto-generated method stub
		return boardDao.updateEdit(editMap);
	}

	@Override
	public int delete(HashMap<String, Object> deleteMap) {
		// TODO Auto-generated method stub
		return boardDao.delete(deleteMap);
	}

	@Override
	public void updateHit(HashMap<String, Object> hitMap) {
		// TODO Auto-generated method stub
		boardDao.updateHit(hitMap);
	}





}
