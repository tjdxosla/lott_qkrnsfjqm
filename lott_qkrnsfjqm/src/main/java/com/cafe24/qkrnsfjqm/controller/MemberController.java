package com.cafe24.qkrnsfjqm.controller;

import java.text.DateFormat;
import java.text.SimpleDateFormat;
import java.util.ArrayList;
import java.util.Date;
import java.util.HashMap;
import java.util.List;

import javax.annotation.Resource;
import javax.servlet.http.HttpServletRequest;
import javax.servlet.http.HttpSession;

import org.slf4j.Logger;
import org.slf4j.LoggerFactory;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Controller;
import org.springframework.stereotype.Service;
import org.springframework.web.bind.annotation.RequestMapping;
import org.springframework.web.servlet.ModelAndView;

import com.cafe24.qkrnsfjqm.dto.UsersDto;
import com.cafe24.qkrnsfjqm.service.UsersService;

@Controller
public class MemberController {

	private static final Logger logger = LoggerFactory.getLogger(MemberController.class);
	
	@Resource(name="usersService")
	private UsersService usersService;
	
	@RequestMapping(value="/member/join")
	public ModelAndView memberJoin(HttpServletRequest req ) {
		
		String check= req.getParameter("checkJoin");
		ModelAndView mav = new ModelAndView();		
		HashMap<String, Object> memParam = new HashMap<String, Object>();		
		UsersDto usersDto = new UsersDto();
		Date dat = new Date();
		SimpleDateFormat sdf = new SimpleDateFormat("yyyy-MM-dd HH:mm:ss");
		String dayTime = sdf.format(dat);	

		if(check==null) {
			
			mav.setViewName("/member/join");
		}else {
			String name = req.getParameter("username");
			String email = req.getParameter("email");
			String pass = req.getParameter("password");
			String phone = req.getParameter("phone");
			
			memParam.put("name", name);
			memParam.put("email", email);
			memParam.put("pass", pass);
			memParam.put("phone", phone);
			memParam.put("created_at", dayTime);
			memParam.put("updated_at", dayTime);			
			
			int result = usersService.insertUser(memParam);
			if(result!=1) {
				mav.addObject("msg", "회원 등록 시 오류가 발생 했습니다. 다시 시도 바랍니다.");
			}else {				
				mav.addObject("msg", "정상 등록 되었습니다. 감사합니다.");
			}
			mav.setViewName("/member/insertResult");
		}		
		
		return mav;			
	}
	
	@RequestMapping(value="/member/insertResult")
	public String memberInserResult() {
		
		return "/member/insertResult";
	}
	
	@RequestMapping(value="/member/login")
	public String memberLogin( ) {
		
		return "/member/login";
	}
	
	@RequestMapping(value="/member/loginProc")
	public ModelAndView memberLoginProc(HttpServletRequest req, HttpSession session) {
		
		ModelAndView mav = new ModelAndView();
		HashMap<String, Object> params = new HashMap<String, Object>();
		HashMap<String, Object> result = new HashMap<String, Object>();
		
		params.put("email", req.getParameter("email"));
		params.put("pass", req.getParameter("pass"));
		
		result = usersService.selectUser(params);	
		
		try {			
		
			if(result!=null) {
				session.setAttribute("email", result.get("email"));
				
				mav.addObject("result", result);
				mav.setViewName("/member/loginProc");
	
			}else {
				session.setAttribute("email", "");
				
				mav.addObject("msg", "회원정보가 없습니다.");
				mav.setViewName("/member/loginProc");
			
			}
		}catch(Exception e) {
			e.printStackTrace();
		}
		return mav;
	}
}
