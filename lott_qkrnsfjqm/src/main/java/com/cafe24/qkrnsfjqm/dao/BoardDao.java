package com.cafe24.qkrnsfjqm.dao;

import java.util.ArrayList;
import java.util.HashMap;
import java.util.List;

import org.mybatis.spring.SqlSessionTemplate;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Repository;

@Repository("boardDao")
public class BoardDao {
	
	@Autowired
	private SqlSessionTemplate sqlSession;

	public List<HashMap<String, Object>> getBoardList() throws Exception{
		// TODO Auto-generated method stub
		
		List<HashMap<String, Object>> listResult = new ArrayList<HashMap<String,Object>>();
		
		try {			
			listResult = sqlSession.selectList("board.list");		
			if(listResult==null) {
				HashMap<String, Object> map = new HashMap<String, Object>();
				map.put("list", 0);
				listResult.add(map); 				
			}
		}catch(Exception e) {
			e.printStackTrace();
		}
		return listResult;
	}

	public int insertWrite(HashMap<String, Object> writeMap) {
		// TODO Auto-generated method stub
		return sqlSession.insert("board.insertWrite", writeMap);
	}

	public HashMap<String, Object> getView(String id) {
		// TODO Auto-generated method stub
		return sqlSession.selectOne("board.getView", id);
	}

	public int updateEdit(HashMap<String, Object> editMap) {
		// TODO Auto-generated method stub
		return sqlSession.update("board.updateEdit", editMap);
	}

	public int delete(HashMap<String, Object> deleteMap) {
		// TODO Auto-generated method stub
		return sqlSession.delete("board.delete", deleteMap);
	}
}
