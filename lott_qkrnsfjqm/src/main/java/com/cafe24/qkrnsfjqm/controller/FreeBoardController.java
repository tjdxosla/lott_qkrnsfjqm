package com.cafe24.qkrnsfjqm.controller;


import java.text.SimpleDateFormat;
import java.util.ArrayList;
import java.util.Date;
import java.util.HashMap;
import java.util.List;

import javax.annotation.Resource;
import javax.servlet.http.HttpServletRequest;

import org.slf4j.Logger;
import org.slf4j.LoggerFactory;
import org.springframework.stereotype.Controller;
import org.springframework.web.bind.annotation.RequestMapping;
import org.springframework.web.servlet.ModelAndView;

import com.cafe24.qkrnsfjqm.service.BoardService;

@Controller
public class FreeBoardController {
	
	private static final Logger logger = LoggerFactory.getLogger(FreeBoardController.class);
	
	@Resource(name="boardService")
	private BoardService boardService;
	
	@RequestMapping(value="/freeBoard/list")
	public ModelAndView freeBoardList( ) throws Exception {
		
		ModelAndView mav = new ModelAndView();
		
		List<HashMap<String, Object>> list = boardService.getBoardList();
		
		mav.addObject("list", list);
		mav.setViewName("/freeBoard/list");
		
		return mav;
	}
	
	@RequestMapping(value="/freeBoard/write")
	public ModelAndView freeBoardWrite() {
		
		ModelAndView mav = new ModelAndView();
		
		mav.setViewName("/freeBoard/write");
		
		return mav;
	}
	
	@RequestMapping(value="/freeBoard/insertWrite")
	public ModelAndView freeBoardInsertWrite(HttpServletRequest req ) {
		ModelAndView mav = new ModelAndView();
		
		Date day = new Date();
		SimpleDateFormat sdf = new SimpleDateFormat("yyyy-MM-dd HH:mm:ss");		
		
		HashMap<String, Object> writeMap = new HashMap<String, Object>();
		
		writeMap.put("name", req.getParameter("name"));
		writeMap.put("pass", req.getParameter("pass"));
		writeMap.put("title", req.getParameter("title"));
		writeMap.put("comment", req.getParameter("comment"));
		writeMap.put("day", sdf.format(day));
		
		int result = boardService.insertWrite(writeMap);
		
		mav.addObject("result", result);
		mav.setViewName("/freeBoard/insertWrite");
		
		
		return mav;
	}
	
	@RequestMapping(value="/freeBoard/view")
	public ModelAndView freeBoardView(HttpServletRequest req) {
		
		ModelAndView mav = new ModelAndView();
		
		String id = req.getParameter("id");
		
		HashMap<String, Object> view = boardService.getView(id);
		
		mav.addObject("view", view);
		mav.setViewName("/freeBoard/view");
		
		return mav;
	}
	
	@RequestMapping(value="/freeBoard/edit")
	public ModelAndView freeBoardEdit(HttpServletRequest req) {
		ModelAndView mav = new ModelAndView();
		
		String id = req.getParameter("id");
		
		HashMap<String, Object> edit = boardService.getView(id);
		
		mav.addObject("edit", edit);
		mav.setViewName("/freeBoard/edit");
		
		return mav;
	}
	
	@RequestMapping(value="/freeBoard/updateEdit")
	public ModelAndView freeBoardUpdateEdit(HttpServletRequest req) {
		
		ModelAndView mav = new ModelAndView();
		
		Date day = new Date();
		SimpleDateFormat sdf = new SimpleDateFormat("yyyy-MM-dd HH:mm:ss");		
		
		HashMap<String, Object> editMap = new HashMap<String, Object>();		
		
		editMap.put("id", req.getParameter("id"));
		editMap.put("name", req.getParameter("name"));
		editMap.put("pass", req.getParameter("pwd"));
		editMap.put("title", req.getParameter("title"));
		editMap.put("content", req.getParameter("comment"));
		editMap.put("day", sdf.format(day));
				
		int result = boardService.updateEdit(editMap);
		
		mav.addObject("result", result);
		mav.setViewName("/freeBoard/updateEdit");
		return mav;		
	}
	
	@RequestMapping(value="/freeBoard/delete")
	public ModelAndView freeBoardDelete(HttpServletRequest req) {
		
		ModelAndView mav = new ModelAndView();
		
		HashMap<String, Object> deleteMap = new HashMap<String, Object>();		
		
		deleteMap.put("id", req.getParameter("id"));
		
		int result = boardService.delete(deleteMap);
		
		mav.addObject("result", result);
		mav.setViewName("/freeBoard/delete");
		
		return mav;
		
	}

}
