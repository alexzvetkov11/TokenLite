/*! TokenLite v1.1.7 | Copyright by Softnio. */
!function(t){"use strict";if(t("#tknSale").length>0){var e=document.getElementById("tknSale").getContext("2d"),o=new Chart(e,{type:"line",data:{labels:tnx_labels,datasets:[{label:"",tension:.4,backgroundColor:"transparent",borderColor:theme_color.base,pointBorderColor:theme_color.base,pointBackgroundColor:"#fff",pointBorderWidth:2,pointHoverRadius:6,pointHoverBackgroundColor:"#fff",pointHoverBorderColor:theme_color.base,pointHoverBorderWidth:2,pointRadius:6,pointHitRadius:6,data:tnx_data}]},options:{legend:{display:!1},maintainAspectRatio:!1,tooltips:{callbacks:{title:function(t,e){return"Date : "+e.labels[t[0].index]},label:function(t,e){return e.datasets[0].data[t.index]+" Tokens"}},backgroundColor:"#f2f4f7",titleFontSize:13,titleFontColor:theme_color.heading,titleMarginBottom:10,bodyFontColor:theme_color.text,bodyFontSize:14,bodySpacing:4,yPadding:15,xPadding:15,footerMarginTop:5,displayColors:!1},scales:{yAxes:[{ticks:{beginAtZero:!0,fontSize:12,fontColor:theme_color.text},gridLines:{color:"#e9edf3",tickMarkLength:0,zeroLineColor:"#e9edf3"}}],xAxes:[{ticks:{fontSize:12,fontColor:theme_color.text,source:"auto"},gridLines:{color:"transparent",tickMarkLength:20,zeroLineColor:"#e9edf3"}}]}}});t(".token-sale-graph li a").on("click",function(e){e.preventDefault();var a=t(this),r=t(this).attr("href");t.get(r).done(t=>{o.data.labels=Object.values(t.chart.days_alt),o.data.datasets[0].data=Object.values(t.chart.data_alt),o.update(),a.parents(".token-sale-graph").find("a.toggle-tigger").text(a.text()),a.closest(".toggle-class").toggleClass("active")})})}if(t("#regStatistics").length>0){var a=document.getElementById("regStatistics").getContext("2d"),r=new Chart(a,{type:"bar",data:{labels:user_labels,datasets:[{label:"",lineTension:0,backgroundColor:theme_color.base,borderColor:theme_color.base,barThickness:.4,data:user_data}]},options:{legend:{display:!1},maintainAspectRatio:!1,tooltips:{callbacks:{title:function(t,e){return!1},label:function(t,e){return e.datasets[0].data[t.index]+" "}},backgroundColor:"#f2f4f7",bodyFontColor:theme_color.base,bodyFontSize:14,bodySpacing:5,yPadding:3,xPadding:10,footerMarginTop:10,displayColors:!1},scales:{yAxes:[{ticks:{beginAtZero:!0,fontSize:10,fontColor:theme_color.text},gridLines:{color:"transparent",tickMarkLength:0,zeroLineColor:"transparent"}}],xAxes:[{ticks:{fontSize:9,fontColor:theme_color.text,source:"auto"},gridLines:{color:"transparent",tickMarkLength:7,zeroLineColor:"transparent"}}]}}});t(".reg-statistic-graph li a").on("click",function(e){e.preventDefault();var o=t(this),a=t(this).attr("href");t.get(a).done(t=>{r.data.labels=Object.values(t.chart.days_alt),r.data.datasets[0].data=Object.values(t.chart.data_alt),r.update(),o.parents(".reg-statistic-graph").find("a.toggle-tigger").text(o.text()),o.closest(".toggle-class").toggleClass("active")})})}window.pieColors={pieColor1:"#00d285",pieColor2:"#ffc100"};if(t("#phaseStatus").length>0){var n=document.getElementById("phaseStatus").getContext("2d");new Chart(n,{type:"doughnut",data:{labels:["Total Sold","Unsold Tokens"],datasets:[{lineTension:0,backgroundColor:[window.pieColors.pieColor1,window.pieColors.pieColor2],borderColor:"#fff",borderWidth:2,hoverBorderColor:"#fff",data:phase_data}]},options:{legend:{display:!1,labels:{boxWidth:10,fontColor:"#000"}},rotation:-1.6,cutoutPercentage:80,maintainAspectRatio:!1,tooltips:{callbacks:{title:function(t,e){return e.labels[t[0].index]},label:function(t,e){return e.datasets[0].data[t.index]+" "}},backgroundColor:"#f2f4f7",titleFontSize:13,titleFontColor:theme_color.heading,titleMarginBottom:10,bodyFontColor:theme_color.text,bodyFontSize:14,bodySpacing:4,yPadding:15,xPadding:15,footerMarginTop:5,displayColors:!1}}})}}(jQuery);