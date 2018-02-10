//
var network;
var container;
var exportButton;

function init(data) {
	container = document.getElementById('network');
	exportButton = document.getElementById('export_button');
	draw(data);
}

function draw(data) {
	//
	var role = $("#network").data("role");
	enable_manipulation = false;
	if (role === "secretary") {
		enable_manipulation = true;
	}
	
	//
	destroy();
	//
	var options = {
		nodes: {
			shape: "box",
			widthConstraint: {
				minimum: 100,
				maximum: 100
			}
		},
		layout: {
			hierarchical: {
				enabled: true,
				parentCentralization: false,
				sortMethod: "directed",
				direction: "LR"
			}
		},
		physics: {
			enabled: false
		},
		interaction: {
			navigationButtons: true,
			keyboard: true
		},
		manipulation: {
			enabled: enable_manipulation,
			addNode: function (data, callback) {
				// filling in the popup DOM elements
				document.getElementById('operation').innerHTML = "Add Node";
				document.getElementById('node-id').value = data.id;
				document.getElementById('node-label').value = data.label;
				document.getElementById('saveButton').onclick = saveData.bind(this, data, callback);
				document.getElementById('cancelButton').onclick = clearPopUp.bind();
				document.getElementById('network-popUp').style.display = 'block';
			},
            editNode: function (data, callback) {
                // filling in the popup DOM elements
                document.getElementById('operation').innerHTML = "Edit Node";
                document.getElementById('node-id').value = data.id;
                document.getElementById('node-label').value = data.label;
                document.getElementById('saveButton').onclick = saveData.bind(this, data, callback);
                document.getElementById('cancelButton').onclick = cancelEdit.bind(this,callback);
                document.getElementById('network-popUp').style.display = 'block';
            },
            addEdge: function (data, callback) {
                saveEdge(data);
                callback(data);
            },
            deleteNode: function (data, callback) {
            	if (data.edges.length > 0) {
            		deleteEdge({id: data.edges});
            	}
            	deleteNode({id:data.nodes});
            	callback(data);
            },
            deleteEdge: function (data, callback) {
            	deleteEdge({id: data.edges});
            	callback(data);
            }
	    }
	};
	// create a network of nodes
	network = new vis.Network(container, data, options);
	
	//
	network.on('click', function(properties){
		if (properties.nodes[0] === undefined) {
			return true;
		}
        //
        $.ajax({
            url: '/api/orgcharts/show_node/' + properties.nodes[0],
            type: 'get',
        })
        .done(function(data){
			// アクセスユーザーのロール取得
			var role = $(".modal-member").data("userRole");
			
			$(".modal-title").text("");
			$(".modal-title").text(data.node.label);
			$("[name='orgchartMember\[orgchart_node_id\]']").val("");
			$("[name='orgchartMember\[orgchart_node_id\]']").val(data.node.id);
			// modal内のフォーム初期化
			$(".member-id").find("select").val("");
			$(".member-name").find("input").val("");
			// modalセット
			$('#myModal').modal('toggle');
			
			// メンバー表示
			$(".modal-member").empty();
			$(data.member).each(function(idx, elm){
    			if (role === 'secretary') {
        			$(".modal-member").append('\
                      <li>\
                        <span class="orgchart-member">' + elm.name + '</span>\
                        <span>\
                          <a href="javascript:void(0);" class="orgchart-member-delete" data-orgchart-member-id="' + elm.orgchart_member_id + '">x</a>\
                        </span>\
                      </li>\
        			');
    			} else {
        			$(".modal-member").append('\
                      <li>\
                        <span class="orgchart-member">' + elm.name + '</span>\
                      </li>\
        			');
    			}
			});
			// セレクトボックス作成
			var obj = $(".member-id").find("select");
			if ($(obj).length > 0) {
				$(obj).empty().append('<option value=""></option>');
				$.each(data.select_option, function(id, name){
					$(obj).append('\
					  <option value="' + id + '">' + name + '</option>\
					');
				});
			}
        })
        .fail(function(data){
            console.log('error');
        });
	});
}

function objectToArray(obj) {
	return Object.keys(obj).map(function(key) {
		obj[key].id = key;
		return obj[key];
	});
}

function addConnections(elem, index) {
	// need to replace this with a tree of the network, then get child direct children of the element
	elem.connections = network.getConnectedNodes(index);
}

function destroy() {
	if (network !== null && network !== undefined) {
		network.destroy();
		network = null;
	}
}

function saveData(data,callback) {
	data.id = document.getElementById('node-id').value;
	data.label = document.getElementById('node-label').value;
	clearPopUp();
	callback(data);
	//
	saveNode(data);
}

function clearPopUp() {
	document.getElementById('saveButton').onclick = null;
	document.getElementById('cancelButton').onclick = null;
	document.getElementById('network-popUp').style.display = 'none';
}

function cancelEdit(callback) {
	clearPopUp();
	callback(null);
}

function saveNode(data) {
    var obj = document.getElementById('node-id');
	$.ajax({
	    url: '/api/orgcharts/save_node',
	    type: 'post',
	    data: data
	})
	.done(function(data){
		location.reload();
	})
	.fail(function(data){
	    console.log('error');
	});
}
function saveEdge(data) {
	$.ajax({
	    url: '/api/orgcharts/add_edge',
	    type: 'post',
	    data: data
	})
	.done(function(data){
	    console.log('success');
	})
	.fail(function(data){
	    console.log('error');
	});
}
function deleteNode(data) {
	$.ajax({
	    url: '/api/orgcharts/delete_node',
	    type: 'post',
	    data: data
	})
	.done(function(data){
	    console.log('success');
	})
	.fail(function(data){
	    console.log('error');
	});
}
function deleteEdge(data) {
	$.ajax({
	    url: '/api/orgcharts/delete_edge',
	    type: 'post',
	    data: data
	})
	.done(function(data){
	    console.log('success');
	})
	.fail(function(data){
	    console.log('error');
	});
}
