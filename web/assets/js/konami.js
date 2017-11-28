$(document).ready(function () {
    if (window.addEventListener) {
        var kkeys = [], konami = "38,38,40,40,37,39,37,39,66,65";
        window.addEventListener("keydown", function (e) {
            kkeys.push(e.keyCode);
            if (kkeys.toString().indexOf(konami) >= 0) {
                var nCageImg = [
                    'http://upload.wikimedia.org/wikipedia/commons/thumb/3/33/Nicolas_Cage_2011_CC.jpg/220px-Nicolas_Cage_2011_CC.jpg',
                    'http://upload.wikimedia.org/wikipedia/commons/thumb/f/f3/Nicolas_Cage_-_66%C3%A8me_Festival_de_Venise_(Mostra).jpg/220px-Nicolas_Cage_-_66%C3%A8me_Festival_de_Venise_(Mostra).jpg',
                    'http://content8.flixster.com/rtactor/40/33/40334_pro.jpg',
                    'http://images.fandango.com/r88.0/ImageRenderer/200/295/images/performer_no_image_large.jpg/0/images/masterrepository/performer%20images/p10155/kickass-pm-4.jpg',
                    'http://images.trulia.com/blogimg/9/d/7/d/1775659_1302741896636_o.jpg',
                    'http://cache2.artprintimages.com/LRG/10/1062/Y4UL000Z.jpg',
                    'http://www3.pictures.fp.zimbio.com/Nicholas+Cage+David+Letterman+-EtX2RCI91al.jpg',
                                        'http://resources2.news.com.au/images/2009/11/04/1225794/400950-nicolas-cage.jpg',
                    'http://www.topnews.in/uploads/Nicolas-Cage1.jpg',
                    'http://starsmedia.ign.com/stars/image/article/908/908074/nicolas-cage-20080905025038648-000.jpg',
                    'http://www.iwatchstuff.com/2012/11/30/nic-cage-in-things.jpg',
                    'http://images.contactmusic.com/newsimages/nicolas_cage_552048.jpg',
                    'http://24.media.tumblr.com/e68455822f14c29d43bacbc19f15ed36/tumblr_mr1kquuOvD1rimb2bo1_400.jpg',
                    'http://static2.businessinsider.com/image/4adcd99800000000009ed0dd/how-nicolas-cage-spent-his-way-to-the-poorhouse.jpg',
                    'http://www1.pictures.zimbio.com/pc/Nicolas+Cage+Nicolas+Cage+Emma+Stone+Croods+AbN87pQpWsjl.jpg'
                ];
                $("img").attr('src', nCageImg[Math.floor((Math.random() * 14) + 1)]);
                kkeys.length = 0;
            }
        }, true);
    }
});