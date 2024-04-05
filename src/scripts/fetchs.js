const baseURL = "http://localhost:8888/Gestion-apprenants/public";
const coursesURL = baseURL + "/courses";
const userCourseSignatureURL = baseURL + "/courses/sign_course";

export async function logout() {
  try {
    const response = await fetch(baseURL + "/logout", {
      method: "GET",
      headers: {
        "Content-Type": "application/json",
      },
    });
    const data = await response.json();
    return data;
  } catch (error) {
    console.error("Erreur lors de la déconnexion ", error);
  }
}

export async function getAllPromotions() {
  try {
    const response = await fetch(baseURL + "/promotions", {
      method: "GET",
      headers: { "Content-Type": "application/json" },
    });
    const data = await response.json();
    return data;
  } catch (error) {
    console.error("Erreur lors de la récupération des promotions", error);
  }
}

export async function getAllCourses() {
  try {
    const response = await fetch(coursesURL, {
      method: "GET",
      headers: {
        "Content-Type": "application/json",
      },
    });
    const data = await response.json();
    return data;
  } catch (error) {
    console.error("Erreur lors de la récupération des cours: ", error);
  }
}

export async function validateCoursePresence(userCourseId) {
  try {
    const response = await fetch(userCourseSignatureURL, {
      method: "POST",
      headers: {
        "Content-Type": "application/json",
      },
      body: JSON.stringify({
        userCourseId: userCourseId,
      }),
    });
    const data = await response.json();
    return data;
  } catch (error) {
    console.error("Erreur lors de la signature: ", error);
  }
}

export async function getUserCourses(user) {
  try {
    const response = await fetch(coursesURL, {
      method: "POST",
      headers: {
        "Content-Type": "application/json",
      },
      body: JSON.stringify({ userId: user.id }),
    });
    const data = await response.json();
    const success = data.success;
    if (!success) {
      alert(data.message);
      return;
    }
    return data;
  } catch (error) {
    console.error("Erreur lors du fetch des cours", error);
  }
}
