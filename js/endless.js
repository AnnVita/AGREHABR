var engine = {

	posts : [],
	target : null,
	busy : false,
	count : 5,

	render : function(obj){
		var xhtml = '<li class="publication">';
                xhtml += '<a href="stream" title="Stream" class="publication_stream">' + obj.flow + ' <i class="fa fa-arrow-right" aria-hidden="true"></i></a>';
                xhtml += '<a href="title" title="title" class="publication_title"> ' + obj.title + '</a>';
                xhtml += '<ul class="hub_list"> <li><a href="URL" title="Hub">' + obj.hubs + '</a></li></ul>';
                xhtml += '<div class="description">' + obj.full_text + '</div>';
                xhtml += '</li>';

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

		for (var i=0, len = posts.length; i<len; i++) {
			this.target.append(this.render(posts[i]));
		}

		if (this.scrollPosition !== undefined && this.scrollPosition !== null) {
			$(window).scrollTop(this.scrollPosition);
		}
	},

	get : function() {

		if (!this.target || this.busy) return;

		if (this.posts && this.posts.length) 
                {
			var lastId = this.posts[this.posts.length-1].id;
		} else 
                {
			var lastId = 0;
		}

		this.setBusy(true);
		var that = this;

		$.getJSON('include/poststopage.php', {count:this.count, last:lastId},
			function(data){
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

		if (bState) {
			$(this.target).append(loading);
			loading.show('slow');
		} else {
			$('#loading').hide();
		}
	},

	setBusy : function(bState){
		this.showLoading(this.busy = bState);
	}
};

// usage
$(document).ready(function(){
	engine.init(null, $(".content_container"));
	engine.get();
});