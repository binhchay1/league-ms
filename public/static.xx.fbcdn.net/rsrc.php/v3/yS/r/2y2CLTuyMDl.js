; /*FB_PKG_DELIM*/

__d("GroupsPluginActionsTypedLogger", ["Banzai", "GeneratedLoggerUtils", "nullthrows"], (function(a, b, c, d, e, f) {
    "use strict";
    a = function() {
        function a() {
            this.$1 = {}
        }
        var c = a.prototype;
        c.log = function(a) {
            b("GeneratedLoggerUtils").log("logger:GroupsPluginActionsLoggerConfig", this.$1, b("Banzai").BASIC, a)
        };
        c.logVital = function(a) {
            b("GeneratedLoggerUtils").log("logger:GroupsPluginActionsLoggerConfig", this.$1, b("Banzai").VITAL, a)
        };
        c.logImmediately = function(a) {
            b("GeneratedLoggerUtils").log("logger:GroupsPluginActionsLoggerConfig", this.$1, {
                signal: !0
            }, a)
        };
        c.clear = function() {
            this.$1 = {};
            return this
        };
        c.getData = function() {
            return babelHelpers["extends"]({}, this.$1)
        };
        c.updateData = function(a) {
            this.$1 = babelHelpers["extends"]({}, this.$1, a);
            return this
        };
        c.setActionSurface = function(a) {
            this.$1.action_surface = a;
            return this
        };
        c.setActionType = function(a) {
            this.$1.action_type = a;
            return this
        };
        c.setGroupid = function(a) {
            this.$1.groupid = a;
            return this
        };
        c.setIsSDK = function(a) {
            this.$1.is_sdk = a;
            return this
        };
        c.setOpensConfirmationDialog = function(a) {
            this.$1.opens_confirmation_dialog = a;
            return this
        };
        c.setPluginAppID = function(a) {
            this.$1.plugin_app_id = a;
            return this
        };
        c.setRefererURL = function(a) {
            this.$1.referer_url = a;
            return this
        };
        c.setViewerJoinState = function(a) {
            this.$1.viewer_join_state = a;
            return this
        };
        c.updateExtraData = function(a) {
            a = b("nullthrows")(b("GeneratedLoggerUtils").serializeMap(a));
            b("GeneratedLoggerUtils").checkExtraDataFieldNames(a, g);
            this.$1 = babelHelpers["extends"]({}, this.$1, a);
            return this
        };
        c.addToExtraData = function(a, b) {
            var c = {};
            c[a] = b;
            return this.updateExtraData(c)
        };
        return a
    }();
    var g = {
        action_surface: !0,
        action_type: !0,
        groupid: !0,
        is_sdk: !0,
        opens_confirmation_dialog: !0,
        plugin_app_id: !0,
        referer_url: !0,
        viewer_join_state: !0
    };
    f["default"] = a
}), 66);
__d("PluginGroup", ["Log"], (function(a, b, c, d, e, f, g) {
    a = function() {
        function a(a) {
            this.$1 = a, d("Log").debug("Plugin element: %s", this.$1.id)
        }
        a.respond = function() {
            d("Log").debug("xhr response received")
        };
        return a
    }();
    g["default"] = a
}), 98);
__d("PluginGroupActionLogger", ["Event", "GroupsPluginActionsTypedLogger"], (function(a, b, c, d, e, f, g) {
    function a(a, b, d, e, f, g, h, i) {
        c("Event").listen(h, "click", function(h) {
            new(c("GroupsPluginActionsTypedLogger"))().setIsSDK(b).setRefererURL(e).setPluginAppID(a).setGroupid(d).setViewerJoinState(f).setActionSurface(g).setActionType("click").setOpensConfirmationDialog(i).log()
        })
    }
    g.initializeClickLogger = a
}), 98);