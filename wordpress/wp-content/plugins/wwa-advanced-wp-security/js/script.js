jQuery(document).ready(function($){function check_theme_file(current){var id=parseInt(current||0);var file=av_files[id];$.post(ajaxurl,{action:"get_ajax_response",_ajax_nonce:av_nonce,_theme_file:file,_action_request:"check_theme_file"},function(input){var item=$("#av_template_"+id);if(input){input=eval("("+input+")");if(!input.nonce||input.nonce!=av_nonce){return}item.addClass("danger");var i,lines=input.data,len=lines.length;for(i=0;i<len;i=i+3){var num=parseInt(lines[i])+1,md5=lines[i+2],line=lines[i+1].replace(/@span@/g,"<span>").replace(/@\/span@/g,"</span>"),file=item.text();item.append('<p><a href="#" id="'+md5+'">'+av_msg_1+"</a> <code>"+line+"</code></p>");$("#"+md5).click(function(){$.post(ajaxurl,{action:"get_ajax_response",_ajax_nonce:av_nonce,_file_md5:$(this).attr("id"),_action_request:"update_white_list"},function(input){if(!input){return}input=eval("("+input+")");if(!input.nonce||input.nonce!=av_nonce){return}var parent=$("#"+input.data[0]).parent();if(parent.parent().children().length<=1){parent.parent().hide("slow").remove()}parent.hide("slow").remove()});return false})}}else{item.addClass("done")}av_files_loaded++;if(av_files_loaded>=av_files_total){$("#av_manual_scan .alert").text(av_msg_3).fadeIn().fadeOut().fadeIn().fadeOut().fadeIn().animate({opacity:1},500).fadeOut("slow",function(){$(this).empty()})}else{check_theme_file(id+1)}})}function manage_options(){var e=$("#av_cronjob_enable"),t=e.parents("fieldset").find(":text, :checkbox").not(e);if(typeof $.fn.prop==="function"){t.prop("disabled",!e.prop("checked"))}else{t.attr("disabled",!e.attr("checked"))}}av_nonce=av_settings.nonce;av_theme=av_settings.theme;av_msg_1=av_settings.msg_1;av_msg_2=av_settings.msg_2;av_msg_3=av_settings.msg_3;$("#av_manual_scan a.button").click(function(){$.post(ajaxurl,{action:"get_ajax_response",_ajax_nonce:av_nonce,_action_request:"get_theme_files"},function(input){if(!input){return}input=eval("("+input+")");if(!input.nonce||input.nonce!=av_nonce){return}var output="";av_files=input.data;av_files_total=av_files.length;av_files_loaded=0;jQuery.each(av_files,function(e,t){output+='<div id="av_template_'+e+'">'+t+"</div>"});$("#av_manual_scan .alert").empty();$("#av_manual_scan .output").empty().append(output);check_theme_file()});return false});$("#av_cronjob_enable").click(manage_options);manage_options()})