<form>

  <!-- Grid -->
  <div class="grid">

    <!-- Markup example 1: input is inside label -->
    <label for="firstname">
      First name
      <input type="text" id="firstname" name="firstname" placeholder="First name" required>
    </label>

    <label for="lastname">
      Last name
      <input type="text" id="lastname" name="lastname" placeholder="Last name" required>
    </label>

  </div>

  <!-- Markup example 2: input is after label -->
  <label for="email">Email address</label>
  <input type="email" id="email" name="email" placeholder="Email address" required>
  <small>We'll never share your email with anyone else.</small>

  <!-- Button -->
  <button type="submit">Submit</button>

</form>