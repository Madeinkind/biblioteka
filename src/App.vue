<template>
	<metainfo>
		<template v-slot:title="{content}">{{content}}</template>
	</metainfo>
	<router-view/>
</template>

<style lang="css">

</style>

<script>
import { useMeta } from 'vue-meta';

export default {
	name: 'App',
	setup() {
		useMeta({
			title: '',
			htmlAttrs: {
				lang: 'en',
				amp: true,
			},
		});
	},
	mounted(){
		window["appComponent"] = this;
	},
};
</script>
