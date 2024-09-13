function include_once_javascript(fileUrl) {

      if (typeof(alreadyIncluded) == "undefined" ){  
            alreadyIncluded = [];
      }
      var found = false;

      for (i = 0; i < alreadyIncluded.length; i++){
          
            if (alreadyIncluded[i] ==  fileUrl){
                console.info("ja foi adicionado");
                found = true;
                break;
            }          
      }

      if (found == true){
          console.info("parar script");
            return true;           
      }

      else {
          console.info("incluir url");
            var script = document.createElement("script");
            var head   = document.getElementsByTagName('head').item(0);
            script.src = fileUrl;
            head.appendChild(script);
            alreadyIncluded[alreadyIncluded.length] = fileUrl; 
            return true;
      }
}