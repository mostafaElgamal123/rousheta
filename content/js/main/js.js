$(document).ready(function() {
$('.owl-carousel').owlCarousel({
    rtl:true,
    loop:true,
    margin:15,
    nav:true,
    responsive:{
        0:{
            items:1
        },
        375:{
           items:2
        },
        500:{
            items:2
        },
        600:{
            items:3
        },
        1000:{
            items:3
        }
    }
})
})
/* js btn more categories */
$('.categories').addClass('solv-height');
$('.more span').click(function(){
    $('.categories').toggleClass('solv-height');
})

/* js items section */
$('.open-section').click(function(){
      $('.items-sections').toggleClass('hide');
      $('.open-section').toggleClass('active');
})

/* js menu toggle */

$('.toggle').click(function(){
    $('.header .menu .menu-list').toggleClass('hiddin');
})
$('.toggle-dash').click(function(){
    $('.dash-header .dash-menu nav').toggleClass('show');
})
/* js loading */
$(document).ready(function(){
    $('.loading').css('display','none');
    $(function(){                   // Start when document ready
        $('#star-rating').rating(); // Call the rating plugin
    });
})
$('.icon-eye').click(function(){
    let type=$('.mybtn').attr('type');
    console.log(type);
    if(type=='password'){
        $('#password').attr('type','text');
    }else{
        $('#password').attr('type','password');
    }
})
document.querySelectorAll('.categories ul li').forEach(function (el) {
    el.addEventListener('click', function (e) {
      document.querySelectorAll('.categories ul li').forEach(x => x.classList.remove('active'));
      e.currentTarget.classList.toggle('active');
    });
  });

  

$(function(){
    $('#star-rating').rating(function(vote, event){
        // we have vote and event variables now, lets send vote to server.
        $.ajax({
            url: "/get_votes.php",
            type: "GET",
            data: {rate: vote},
        });
    });
});


//////////////////////////////////////////////////////////////////////////////////////////////
const express = require('express');
const multer = require('multer');
const app = express();
const fs = require('fs');
var Tesseract = require('tesseract.js');

//middlewares
app.set('view engine', 'ejs');
app.use(express.urlencoded({ extended: true }));

app.use(express.json());

const PORT = process.env.PORT | 5000;

var Storage = multer.diskStorage({
  destination: (req, file, callback) => {
    callback(null, __dirname + '/images');
  },
  filename: (req, file, callback) => {
    callback(null, file.originalname);
  }
});

var upload = multer({
  storage: Storage
}).single('image');
//route
app.get('/', (req, res) => {
  res.render('test');
});

app.post('/upload', (req, res) => {
  console.log(req.file);
  upload(req, res, err => {
    if (err) {
      console.log(err);
      return res.send('Something went wrong');
    }

    var image = fs.readFileSync(
      __dirname + '/images/' + req.file.originalname,
      {
        encoding: null
      }
    );
    Tesseract.recognize(image,'eng',{logger: e => console.log(e) })
      .progress(function(p) {
        console.log('progress', p);
      })
      .then(result => {
        res.send(result.text);
    });
  });
});

app.get('/showdata', (req, res) => {});

app.listen(PORT, () => {
  console.log(`Server running on Port ${PORT}`);
});