package com.cafe24.qkrnsfjqm.controller;

import javax.servlet.http.HttpServletRequest;

import org.slf4j.Logger;
import org.slf4j.LoggerFactory;
import org.springframework.stereotype.Controller;
import org.springframework.web.bind.annotation.RequestMapping;
import org.springframework.web.servlet.ModelAndView;

@Controller
public class MemberController {

	private static final Logger logger = LoggerFactory.getLogger(MemberController.class);
	
	@RequestMapping(value="/member/join")
	public ModelAndView memberJoin(HttpServletRequest req ) {
		
		String check= req.getParameter("checkJoin");
		ModelAndView mav = new ModelAndView();
		
		if(check==null) {
			System.out.println("ภฬมฆดย : "+check);
			mav.setViewName("/member/join");
		}else {
			String name = req.getParameter("username");
			String email = req.getParameter("email");
			String pass = req.getParameter("password");
			String phone = req.getParameter("phone");
			
			
			mav.setViewName("main/index");	
		}
		
		
		return mav;			
	}
}
