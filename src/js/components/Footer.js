import React from "react";


export default class Footer extends React.Component {
	constructor() {
		super();
		this.state = {
			title: "TITLE",
		};
	}


  render() {
    return (

        <div>
          <p>Create Account</p>
          <footer>Username:</footer>
          <footer>Password:</footer>
          <footer>Confirm Password:</footer>
          <footer>Email:</footer>
        </div>


    );
  }
}
