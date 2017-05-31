$("#events-create").validate({
            rules: {
                eventName:{
                        required: true 
                    },
                eventUrl:{
                        required: true
                    },
                fromDate:{
                        required: true
                    },
                fromTime:{
                        required: true
                    },
                toDate:{
                        required: true
                    },
                toTime:{
                        required: true
                    },
                eventDesc:{
                        required: true
                    },
                eventTags:{
                        required: true
                    },
                location:{
                        required: true
                    },
                }
 	
        }); 
$("#events-update").validate({
            rules: {
                eventName:{
                        required: true 
                    },
                eventUrl:{
                        required: true
                    },
                fromDate:{
                        required: true
                    },
                fromTime:{
                        required: true
                    },
                toDate:{
                        required: true
                    },
                toTime:{
                        required: true
                    },
                eventDesc:{
                        required: true
                    },
                eventTags:{
                        required: true
                    },
                location:{
                        required: true
                    },
                }
    
        }); 