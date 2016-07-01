
var engine = {

	posts : [],
	target : null,
	busy : false,
	count : 5,

	render : function(obj){
		var xhtml = '<li class="publication" id="post_' + obj.page_id + '">';
                xhtml += '<div class = date>' + obj.post_time + '</div>';
                xhtml += '<a href="https://habrahabr.ru/all/" title="Stream" class="publication_stream">' + obj.flow + ' <i class="fa fa-arrow-right" aria-hidden="true"></i></a>';
                xhtml += '<a href="https://habrahabr.ru/post/' + obj.page_id + '" title="title" class="publication_title"> ' + obj.title + '</a>';
                xhtml += '<ul class="hub_list"> <li><a href="URL" title="Hub">' + obj.hubs + '</a></li></ul>';
                xhtml += '<div class="description">' + obj.description + '</div>';
                xhtml += '<ul class="hub_list"> <li><a href="URL" title="Hub">' + obj.tags + '</a></li></ul>';
                xhtml += '<div class="publication_footer">';
                xhtml += '<i class="fa fa-eye" aria-hidden="true"></i><span class=views>'+ obj.views +'</span>';
                xhtml += '<i class="fa fa-certificate" aria-hidden="true"></i><span class=favorite>'+ obj.favorite +'</span>';
                xhtml += '<a href="https://habrahabr.ru/post/' + obj.page_id + '" class="read_all">Читать на сайте</a></div>';
                xhtml += '</li>';
                lastId++;
		return xhtml;
	},

	init : function(posts, target){
	
		if (!target)
			return;
		
		this.target = $(target);
		
		this.append(posts);

		var that = this;
		$(window).scroll(function(){
			if ($(document).height() - $(window).height() <= $(window).scrollTop() + 50) {
				that.scrollPosition = $(window).scrollTop();
				that.get();
			}
		});
	},

	append : function(posts){
		posts = (posts instanceof Array) ? posts : [];
		this.posts = this.posts.concat(posts);

		for (var i=0, len = posts.length; i < len; i++) 
                {
			this.target.append(this.render(posts[i]));
		}

		if (this.scrollPosition !== undefined && this.scrollPosition !== null) {
			$(window).scrollTop(this.scrollPosition);
		}
	},

	get : function() {

		if (!this.target || this.busy) return;
		this.setBusy(true);
		var that = this;
              		$.getJSON('include/poststopage.php', {count:this.count, last:lastId, theme:postsParams.theme, time:postsParams.time, sortby:postsParams.sortby},
			function(data)
                        {
				if (data.length > 0) 
                                {
					that.append(data);
				}
				that.setBusy(false);
			}
		);
	},

	showLoading : function(bState){
		var loading = $('#loading');

		if (bState) 
                {
			$(this.target).append(loading);
			loading.show('slow');
		} else 
                {
			$('#loading').hide();
		}
	},

	setBusy : function(bState){
		this.showLoading(this.busy = bState);
	}
};

$(document).ready(function(){
	engine.init(null, $(".content_container"));
	engine.get();
    
 
});