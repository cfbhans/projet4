// JavaScript source code

//Script de la modal

	tinymce.init({
		selector: '#newPostContent',
		plugins: 'lists media table',
		toolbar: 'undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | outdent indent a11ycheck addcomment showcomments casechange checklist code formatpainter pageembed permanentpen table',
		toolbar_drawer: 'floating',
		tinycomments_mode: 'embedded',
		tinycomments_author: 'Author name',
		hidden_input: false,
	    forced_root_block : "", 
	    force_br_newlines : true,
	    force_p_newlines : false,
		/*inline: true, !!!!!! LIGNE BLOQUANTE POUR L'INITIALISATION  de tinyMCE !!!!!! */
	});


