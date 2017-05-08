  app.directive('validFile',function(){
  return {
    require:'ngModel',
    link:function(scope,el,attrs,ngModel){
      el.bind('change',function(){
        scope.$apply(function(){
          var extension=el.val().split('.').pop();
          if(extension=="doc" || extension=="docx" || extension=="xls" || extension=="xlsx"  || extension=="ppt" || extension=="pptx" || extension=="pdf" || extension=="gif" || extension=="jpg" || extension=="png"){
            ngModel.$setViewValue(el.val());
          }
          else{
            ngModel.$setViewValue("");
          }
          ngModel.$render();
        });
      });
    }
  }
 }); 
