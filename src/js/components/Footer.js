import React from "react";


export default class Footer extends React.Component {
	constructor() {
		super();
		this.state = {
			title: "TITLE",
		};
	}

  handelChange(e) {
    const title = e.target.value;
    this.props.changeTitle(title);
  }

	changeTitle(title){
		this.setState({title})
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
