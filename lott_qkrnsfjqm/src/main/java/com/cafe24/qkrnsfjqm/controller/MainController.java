package com.cafe24.qkrnsfjqm.controller;

import java.io.IOException;

import org.jsoup.Jsoup;
import org.jsoup.nodes.Document;
import org.jsoup.select.Elements;
import org.slf4j.Logger;
import org.slf4j.LoggerFactory;
import org.springframework.stereotype.Controller;
import org.springframework.web.bind.annotation.RequestMapping;
import org.springframework.web.bind.annotation.RequestMethod;

import com.cafe24.qkrnsfjqm.HomeController;

@Controller
public class MainController {
	
	private static final Logger logger = LoggerFactory.getLogger(MainController.class);
	
	@RequestMapping(value = "/main/", method = RequestMethod.GET)
	public String mainIndex() throws IOException {

		        String URL = "http://www.nlotto.co.kr/common.do?method=getLottoNumber&drwNo=";
		        Document doc = Jsoup.connect(URL).get();
		        Elements elem = doc.select("html");
		        String str = elem.text();
		        System.out.println(str);
		
		return "/main/index";		
	}
	

}
