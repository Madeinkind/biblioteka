export default {
	computed:
	{
		appModel()
		{
			return this.$store.state.app;
		},
		authModel()
		{
			return this.$store.state.app.auth;
		},
		
		store()
		{
			return this.$store;
		},
		state()
		{
			return this.$store.state;
		},
		routeName()
		{
			return this.$route.name;
		},
	},
	methods:
	{
		setPageTitle(title)
		{
			this.appModel.setPageTitle(title);
		},
	},
};
