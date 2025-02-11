import React, { useEffect, useState } from "react";
import ReactDOM from "react-dom";

const Popup = ({ title, description }) => {
	return (
		<div className="popup">
			<h2>{title}</h2>
			<p>{description}</p>
		</div>
	);
};

document.addEventListener("DOMContentLoaded", () => {
	fetch("/wp-json/artistudio/v1/popup")
		.then((response) => response.json())
		.then((data) => {
			ReactDOM.render(
				<Popup title={data.title} description={data.description} />,
				document.getElementById("popup-container"),
			);
		});
});
