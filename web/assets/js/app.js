var app = new Vue({
    delimiters: ['${', '}'],
    el: '.result',
    data: {
        softwaresList : [],
        sms: false,
        mail: false,
        rgpd: false,
        popin: false,
        mailpostal: false,
        callCenter: false,
        pushmobile: false,
        api: false,
        reportcreation: false,
        reportperiodic: false,
        emailsupport: false,
        phonesupport: false,
        chatsupport: false,
        landing: false,
        formulaire: false,
        codesuivi: false,
        livechat: false,
        knowledgebase: false,
        technicalDoc: false,
        twitterMon: false,
        twitterAuto: false,
        linkedinAuto: false,
        linkedinMon: false,
        instagramMon: false,
        instagramAuto: false,
        facebookMon: false,
        facebookAuto: false,
        SegmentCreation: false,
        IntelligentSegmentCreation: false,
        AutoResponder: false,
        LeadScoring: false,
        CreationCampaign: false,
        DripMarketingCampaign: false,
        DragAndDrop: false,
        ContactObject: false,
        CompanyObject: false,
        DefinedFields: false,
        IllimitedFields: false,
        ImportCsv: false,
        AutoDuplicate: false,
        LeadStages: false,
        ProviderEmailChoice: false,
        BlogEdition: false,
        TouchPad: false,
        RssToEmail: false,
        SmtpRelay: false,
        price: 0,
    },
    created(){
        url = $("#results").data("url");

        axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
        axios.get(url, {
            headers: {
                'Content-Type': 'application/json'
            },
            transformResponse: axios.defaults.transformResponse.concat((data) => {
                this.softwaresList = data.data
            })
        })
    },

    methods:{

        reset(){
            this.price = 0;
            this.sms = false;
            this.mail =  false;
            this.rgpd = false;
            this.popin = false;
            this.mailpostal = false;
            this.callCenter = false;
            this.pushmobile = false;
            this.api = false;
            this.reportcreation = false;
            this.reportperiodic = false;
            this.emailsupport = false;
            this.phonesupport = false;
            this.chatsupport = false;
            this.landing = false;
            this.formulaire = false;
            this.codesuivi = false;
            this.livechat = false;
            this.knowledgebase = false;
            this.technicalDoc = false;
            this.twitterMon = false;
            this.twitterAuto = false;
            this.linkedinAuto = false;
            this.linkedinMon = false;
            this.instagramMon = false;
            this.instagramAuto = false;
            this.facebookMon = false;
            this.facebookAuto = false;
            this.SegmentCreation = false;
            this.IntelligentSegmentCreation = false;
            this.AutoResponder = false;
            this.LeadScoring = false;
            this.CreationCampaign = false;
            this.DripMarketingCampaign = false;
            this.DragAndDrop = false;
            this.ContactObject = false;
            this.CompanyObject = false;
            this.DefinedFields = false;
            this.IllimitedFields = false;
            this.ImportCsv = false;
            this.AutoDuplicate = false;
            this.LeadStages = false;
            this.ProviderEmailChoice = false;
            this.BlogEdition = false;
            this.TouchPad = false;
            this.RssToEmail = false;
            this.SmtpRelay = false;
        }


    },
    computed: {

        sofwarefiltres: function(){
            let condFbMon = true;
            let condFbAuto = true;
            let condInstagramMon = true;
            let condinstragramAuto = true;
            let condlinkedinAuto = true;
            let condlinkedinMon = true;
            let condtwitterMon = true;
            let condtwitterAuto= true;
            let condSms = true;
            let condMail = true;
            let condRgpd = true;
            let condPopin = true;
            let condMailPostal = true;
            let condCallCenter = true;
            let condPushmobile = true;
            let condisApi = true;
            let condReportCreation = true;
            let condReportPeriodic = true;
            let condEmailSupport = true;
            let condPhoneSupport = true;
            let condChatSupport = true;
            let condLanding = true;
            let condForm = true;
            let condCodesuivi = true;
            let condLivechat = true;
            let condisKnowledgeBase = true;
            let condTechnicalDoc = true;
            let condSegmentCreation = true;
            let condIntelligentSegmentCreation = true;
            let condAutoResponder = true;
            let condLeadScoring = true;
            let condisCreationCampaign = true;
            let condisDripMarketingCampaign = true;
            let condisDragAndDrop = true;
            let condisContactObject = true;
            let condisCompanyObject = true;
            let condisDefinedFields = true;
            let condisIllimitedFields = true;
            let condisImportCsv = true;
            let condisAutoDuplicate = true;
            let condisLeadStages = true;
            let condisProviderEmailChoice = true;
            let condisisBlogEdition = true;
            let condisisTouchPad = true;
            let condisRssToEmail = true;
            let condisSmtpRelay = true;

            return this.softwaresList.filter((elt) => {
                let condPrice = true;
                if(this.facebookMon === true){
                    condFbMon = elt.isFbMon;
                }
                if(parseInt(this.price) > 10){
                    condPrice = (parseInt(elt.isPrice) < parseInt(this.price)) || (elt.isPrice === "");
                }
                if(this.SmtpRelay === true){
                    condisSmtpRelay = elt.isSmtpRelay
                }
                if(this.RssToEmail === true){
                    condisRssToEmail = elt.isRssToEmail
                }
                if(this.TouchPad === true){
                    condisisTouchPad = elt.isTouchPad
                }
                if(this.BlogEdition === true){
                    condisisBlogEdition = elt.isBlogEdition
                }
                if(this.ProviderEmailChoice === true){
                    condisProviderEmailChoice = elt.isProviderEmailChoice
                }
                if(this.LeadStages === true){
                    condisLeadStages = elt.sLeadStages
                }
                if(this.AutoDuplicate === true){
                    condisAutoDuplicate = elt.isAutoDuplicate
                }
                if(this.ImportCsv === true){
                    condisImportCsv = elt.isImportCsv
                }
                if(this.IllimitedFields === true){
                    condisIllimitedFields = elt.isIllimitedFields
                }
                if(this.DefinedFields === true){
                    condisDefinedFields = elt.isDefinedFields
                }
                if(this.CompanyObject === true){
                    condisCompanyObject = elt.isCompanyObject
                }
                if(this.ContactObject === true){
                    condisContactObject = elt.isContactObject
                }
                if(this.DragAndDrop === true){
                    condisDragAndDrop = elt.isDragAndDrop
                }
                if(this.DripMarketingCampaign === true){
                    condisDripMarketingCampaign = elt.isDripMarketingCampaign
                }
                if(this.CreationCampaign === true){
                    condisCreationCampaign = elt.isCreationCampaign
                }
                if(this.LeadScoring === true){
                    condLeadScoring = elt.isLeadScoring
                }
                if(this.AutoResponder === true){
                    condAutoResponder = elt.isAutoResponder
                }
                if(this.IntelligentSegmentCreation === true){
                    condIntelligentSegmentCreation = elt.isIntelligentSegmentCreation
                }
                if(this.facebookAuto === true){
                    condFbAuto = elt.isFbAuto
                }
                if(this.SegmentCreation === true){
                    condSegmentCreation = elt.isSegmentCreation
                }
                if(this.twitterAuto === true){
                    condtwitterAuto = elt.isTwitterAutoPublication
                }
                if(this.twitterMon === true){
                    condtwitterMon = elt.isTwitterMonitoring
                }
                if(this.linkedinAuto === true){
                    condlinkedinAuto = elt.isLinkedinAutoPublication
                }
                if(this.linkedinMon === true){
                    condlinkedinMon = elt.isLinkedinMonitoring
                }
                if(this.instagramMon === true){
                    condInstagramMon = elt.isInstagramMonitoring
                }
                if(this.instagramAuto === true){
                    condinstragramAuto = elt.isInstagramAutoPublication
                }

                if(this.knowledgebase === true){
                    condisKnowledgeBase = elt.isKnowledgeBase
                }

                if(this.knowledgebase === true){
                    condisKnowledgeBase = elt.isKnowledgeBase
                }
                if(this.technicalDoc === true){
                    condTechnicalDoc = elt.isTechnicalDocument
                }

                if(this.formulaire === true){
                    condForm = elt.isForm
                }
                if(this.codesuivi === true){
                    condCodesuivi = elt.isTracking
                }
                if(this.livechat === true){
                    condLivechat = elt.isLiveChat
                }
                if(this.sms === true){
                    condSms = elt.isSms
                }
                if(this.rgpd === true){
                    condRgpd = elt.isRgpd
                }
                if(this.mail === true){
                    condMail = elt.isEmail
                }
                if(this.popin === true){
                    condPopin = elt.isPopin
                }
                if(this.mailpostal === true){
                    condMailPostal = elt.isMailPostal
                }
                if(this.callCenter === true){
                    condCallCenter = elt.isCallCenter
                }
                if(this.pushmobile === true){
                    condPushmobile = elt.isPushMobile
                }
                if(this.api === true){
                    condisApi = elt.isApi
                }
                if(this.reportcreation === true){
                    condReportCreation = elt.isActivityReportCreation
                }
                if(this.reportperiodic === true){
                    condReportPeriodic = elt.isActivityReportPeriodicSend
                }
                if(this.emailsupport === true){
                    condEmailSupport = elt.isEmailSupport
                }
                if(this.phonesupport === true){
                    condPhoneSupport = elt.isPhoneSupport
                }
                if(this.chatsupport === true){
                    condChatSupport = elt.isChatSupport
                }
                if(this.landing === true){
                    condLanding = elt.isLandingPage
                }


                return  condSms &&
                    condMail &&
                    condRgpd &&
                    condPopin &&
                    condCallCenter &&
                    condMailPostal &&
                    condPushmobile &&
                    condisApi &&
                    condReportCreation &&
                    condReportPeriodic &&
                    condPhoneSupport &&
                    condEmailSupport &&
                    condChatSupport &&
                    condLanding  &&
                    condForm &&
                    condCodesuivi &&
                    condisKnowledgeBase &&
                    condTechnicalDoc &&
                    condLivechat &&
                    condInstagramMon &&
                    condinstragramAuto &&
                    condlinkedinAuto &&
                    condlinkedinMon &&
                    condtwitterMon &&
                    condtwitterAuto &&
                    condSegmentCreation &&
                    condIntelligentSegmentCreation &&
                    condLeadScoring &&
                    condisCreationCampaign &&
                    condisDripMarketingCampaign &&
                    condisDragAndDrop &&
                    condisContactObject &&
                    condisCompanyObject &&
                    condisDefinedFields &&
                    condisIllimitedFields &&
                    condisImportCsv &&
                    condisLeadStages &&
                    condisAutoDuplicate &&
                    condisProviderEmailChoice &&
                    condisisBlogEdition &&
                    condisisTouchPad &&
                    condisRssToEmail &&
                    condAutoResponder &&
                    condPrice
                    ;
            });

        }
    }

});
