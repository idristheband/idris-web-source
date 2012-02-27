/**
 * Name:        formCheck.js
 * Author:      S van der Linden
 * Version:     1.0
 * Lastedited:  19-05-02
 * Status:      PENDING FOR LIBRARY OWNER REVIEW
 *
 * Description: this script returns all the values in a form in one string and can restore a forms settings based on
 *              the same type of string or by passing arbitrary values.
 *
 * Usage:
 * var formHandler = new FormHandler();
 * see forms.test.html for an example
 *
 * Functions (see docs for more info about the parameters):
 * collectVars (Form form, [char elementdelimiter, default=;], [char valuedelimiter, default=|]): string
 * restoreInterface (Array keyValuePairs, Form form, [char valuedelimiter, default=|])
 * transformVars (String arg):Array keyValuePairs
 * getDefaultElementDelimiter():char
 * getDefaultValueDelimiter():char
 *
 *
 */
 function checkSubmitForm (theForm) {
    var missing = checkForm(theForm);
    if (missing.length == 0) { theForm.submit() } else {
        for (var i=0;i<missing.length;i++) {
            missing[i]= missing[i].replace("_"," ");
            missing[i] = " - "+missing[i]+'\n';
        }
        var errorString;
        errorString = 'De volgende velden moeten ingevuld worden :\n' + missing.join("");
        alert(errorString);
    }
 }

 function checkForm (theForm) {
            //visit all forms elements
            var missing = new Array();
            var required = new Array();
            var elements=theForm.length;

            for (var i=0;i<theForm.length;i++) {
                var theEl=theForm[i];
                if (theEl.name == 'required') {
                    var fields = theEl.value;
                    required = fields.split(";");
                }   
            }
            
            for (var i=0;i<required.length;i++) {
                var field = required[i];
                var theEl = theForm[field];


                switch (theEl.type) {
                    case 'textarea':
                        if (!theEl.value) {
                            missing.push(theEl.name)
                        }
                        break;
                    case 'text':
                        if (!theEl.value) {
                            missing.push(theEl.name)
                        }
                        break;
                    case 'hidden':
                        if (!theEl.value) {
                            missing.push(theEl.name)
                        }
                        break;
                    case 'radio':
                        if (!oneSelected(theForm[theEl.name])) {
                            missing.push(theEl.name)
                        }
                        break;
                    case 'checkbox':
                        if (!oneSelected(theForm[theEl.name])) {
                            missing.push(theEl.name)
                        }
                        break;
                    case 'select-one':
                        //name and selected option's value
                        if (theEl.selectedIndex == 0) {
                            missing.push(theEl.name)
                        }
                        break;
                    case 'select-multiple':
                        var check=0;
                        for (var x = 0; x < theEl.length; x++) {
                            if (theEl.options[x].selected) {
                                check++                         
                            }
                        }
                        if (check==0) {
                            missing.push(theEl.name)
                        }
                        break;              
                    default:
                        break;
                }
            }
            return (missing)
        }
    
    /**
     * Returns true if at one radio in a group is selected, false if none are.
     *
     * @param radio the radio object to check
     * @return boolean denoting whether at least one radio is selected
     */
     function oneSelected(radio) {
            for (var i=0; i<radio.length; i++) {
                if (radio[i].checked) return true
          }
          return false
     }
