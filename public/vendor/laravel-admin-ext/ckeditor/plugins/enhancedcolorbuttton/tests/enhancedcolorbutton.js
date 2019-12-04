﻿(function(){bender.editor=!0;bender.test({"test opening text/background color":function(){var a=this.editor,b=this.editorBot,c=a.ui.get("TextColor2"),d=a.ui.get("BGColor2");b.setHtmlWithSelection('[\x3ch1 style\x3d"color: #00FF00; background: #FF0000"\x3eMoo\x3c/h1\x3e]');c.click(a);assert.areEqual("#00ff00",CKEDITOR.tools.convertRgbToHex(c.onOpen()),"Text color must match.");d.click(a);assert.areEqual("#ff0000",CKEDITOR.tools.convertRgbToHex(d.onOpen()),"Text color must match.")},"test open palette without focus":function(){var a=
CKEDITOR.replace("noFocus");a.on("instanceReady",function(){resume(function(){var b=a.ui.get("TextColor2");b.click(a);assert.areEqual(CKEDITOR.TRISTATE_ON,b._.state,"txtColorBtn.click should not throw an error.")})});wait()},"test enableAutomatic\x3dtrue option":function(){bender.editorBot.create({name:"editor1",config:{colorButton_enableAutomatic:!0}},function(a){a=a.editor;var b=a.ui.get("TextColor2"),c=a.ui.get("BGColor2");b.click(a);assert.areEqual(1,b._.panel.getBlock(b._.id).element.find(".cke_colorauto").count(),
"Automatic button should be visible.");c.click(a);assert.areEqual(1,c._.panel.getBlock(c._.id).element.find(".cke_colorauto").count(),"Automatic button should be visible.")})},"test enableAutomatic\x3dfalse option":function(){bender.editorBot.create({name:"editor2",config:{colorButton_enableAutomatic:!1}},function(a){a=a.editor;var b=a.ui.get("TextColor2"),c=a.ui.get("BGColor2");b.click(a);assert.areEqual(0,b._.panel.getBlock(b._.id).element.find(".cke_colorauto").count(),"Automatic button should not be visible.");
c.click(a);assert.areEqual(0,c._.panel.getBlock(c._.id).element.find(".cke_colorauto").count(),"Automatic button should not be visible.")})},"test applying text colors":function(){var a=this.editor;this.editorBot.setHtmlWithSelection("[\x3cp\x3eTest sentence for color change\x3c/p\x3e]");a.execCommand("setForeFontColor",["#ffff00"]);a=CKEDITOR.tools.convertRgbToHex(a.editable().find("span").getItem(0).getAttributes().style).replace(/\s+/g,"").replace(/;+/g,"").toLowerCase();assert.areEqual("color:#ffff00",
a,"text color should be changed with selected one")},"test applying background colors":function(){var a=this.editor;this.editorBot.setHtmlWithSelection("[\x3cp\x3eTest sentence for color change\x3c/p\x3e]");a.execCommand("setBackFontColor",["#ffd700"]);a=CKEDITOR.tools.convertRgbToHex(a.editable().find("span").getItem(0).getAttributes().style).replace(/\s+/g,"").replace(/;+/g,"").toLowerCase();assert.areEqual("background-color:#ffd700",a,"background color should be changed with selected one")},"test quick apply button of text color":function(){var a=
this.editor,b=this.editorBot,c=a.ui.get("TextColor");b.setHtmlWithSelection("[\x3cp\x3eTest sentence for color change\x3c/p\x3e]");a.execCommand("setForeFontColor",["#008000"]);b.setHtmlWithSelection("[\x3cp\x3eAnother test sentence for color change\x3c/p\x3e]");c.click(a);a=CKEDITOR.tools.convertRgbToHex(a.editable().find("span").getItem(0).getAttributes().style).replace(/\s+/g,"").replace(/;+/g,"").toLowerCase();assert.areEqual("color:#008000",a,"text color should be changed with lastly used one")},
"test quick apply button of backgound color":function(){var a=this.editor,b=this.editorBot,c=a.ui.get("BGColor");b.setHtmlWithSelection("[\x3cp\x3eTest sentence for color change\x3c/p\x3e]");a.execCommand("setBackFontColor",["#d3d3d3"]);b.setHtmlWithSelection("[\x3cp\x3eAnother test sentence for color change\x3c/p\x3e]");c.click(a);a=CKEDITOR.tools.convertRgbToHex(a.editable().find("span").getItem(0).getAttributes().style).replace(/\s+/g,"").replace(/;+/g,"").toLowerCase();assert.areEqual("background-color:#d3d3d3",
a,"text color should be changed with lastly used one")},"test indicator of text color":function(){CKEDITOR.env.ie&&assert.ignore();var a=this.editor;this.editorBot.setHtmlWithSelection("[\x3cp\x3eTest sentence for color change\x3c/p\x3e]");a.execCommand("setForeFontColor",["#faebd7"]);a=CKEDITOR.tools.convertRgbToHex(document.getElementById(a.name+"_enhanced_color_button_text").style.backgroundColor).toLowerCase();assert.areEqual("#faebd7",a,"background color of indicator should be set with lastly used one")},
"test indicator of background color":function(){CKEDITOR.env.ie&&assert.ignore();var a=this.editor;this.editorBot.setHtmlWithSelection("[\x3cp\x3eTest sentence for color change\x3c/p\x3e]");a.execCommand("setBackFontColor",["#ffd700"]);a=CKEDITOR.tools.convertRgbToHex(document.getElementById(a.name+"_enhanced_color_button_bg").style.backgroundColor).toLowerCase();assert.areEqual("#ffd700",a,"background color of indicator should be set with lastly used one")}})})();