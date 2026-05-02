import { useState } from "react";
import "./App.css";

function App() {
  const [name, setName] = useState("");
  const [email, setEmail] = useState("");
  const [phone, setPhone] = useState("");

  const [submittedData, setSubmittedData] = useState(null);
  const [error, setError] = useState("");

  function handleSubmit(e) {
    e.preventDefault();

    if (name === "" || email === "" || phone === "") {
      setError("All fields are required");
      return;
    }

    if (!email.includes("@")) {
      setError("Enter a valid email");
      return;
    }

    if (phone.length !== 10) {
      setError("Phone number must be 10 digits");
      return;
    }

    setSubmittedData({
      name: name,
      email: email,
      phone: phone
    });

    setError("");

    setName("");
    setEmail("");
    setPhone("");
  }

  return (
    <div className="container">
      <h2>Dynamic Form Handling</h2>

      <form onSubmit={handleSubmit}>
        <label>Name:</label>
        <input
          type="text"
          placeholder="Enter name"
          value={name}
          onChange={(e) => setName(e.target.value)}
        />

        <label>Email:</label>
        <input
          type="email"
          placeholder="Enter email"
          value={email}
          onChange={(e) => setEmail(e.target.value)}
        />

        <label>Phone:</label>
        <input
          type="text"
          placeholder="Enter phone"
          value={phone}
          onChange={(e) => setPhone(e.target.value)}
        />

        <button type="submit">Submit</button>
      </form>

      <p className="error">{error}</p>

      {submittedData && (
        <div className="result">
          <h3>Submitted Data</h3>
          <p><b>Name:</b> {submittedData.name}</p>
          <p><b>Email:</b> {submittedData.email}</p>
          <p><b>Phone:</b> {submittedData.phone}</p>
        </div>
      )}
    </div>
  );
}

export default App;